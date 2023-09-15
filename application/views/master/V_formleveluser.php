<?php $this->load->view('template/headbar'); ?>

<?php if($aksi == 'aksi_add'){
    $id               = "";
    $kode             = "";
    $levelnm          = "";
    $ori_akses        = "";
    $audit_akses      = "";
    $bagianid         = "";
    $id_company       = "";
    $id_divisi        = "";
    $id_dept          = "";
    $id_bagian        = "";

    $btn_create       = "";
    $btn_update       = "";
    $btn_delete       = "";
    $btn_complete     = "";
    $btn_delete_dh    = "";
    $btn_export_pdf   = "";
    $btn_export_excel = "";
    $btn_restore      = "";
    $bagian_akses     = "";
    $lvid_audit       = "";
}else{
    foreach($dtlevel as $rowlevel){
        $id                 = $rowlevel->leveluserid;
        $levelnm            = $rowlevel->levelusernm;
        $bagian_akses       = $rowlevel->bagian_akses;
        $ori_akses          = $rowlevel->ori_akses;
        $audit_akses        = $rowlevel->audit_akses;
        $bagianid           = $rowlevel->bagid;
        $lvid_audit         = $rowlevel->lvid_audit;
        $id_company         = $rowlevel->id_company;
        $id_divisi          = $rowlevel->id_divisi;
        $id_dept            = $rowlevel->id_dept;
        $id_bagian          = $rowlevel->id_bagian;
    }

    $arr_bagian_akses         = explode(',',$bagian_akses);

    foreach($allbutton as $rowallbutton){
        $btn_create       = $rowallbutton->btn_create;
        $btn_update       = $rowallbutton->btn_update;
        $btn_delete       = $rowallbutton->btn_delete;
        $btn_complete     = $rowallbutton->btn_complete;
        $btn_delete_dh    = $rowallbutton->btn_delete_dh;
        $btn_export_pdf   = $rowallbutton->btn_export_pdf;
        $btn_export_excel = $rowallbutton->btn_export_excel;
        $btn_restore      = $rowallbutton->btn_restore;
    }
} ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?= $Titel ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <form action="<?= base_url('master/C_userlevel/form/'.$aksi); ?>" method="post">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="col-12" align="left">
                                <?php if(isset($message)){ ?>
                                    <div class="alert alert-warning">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Warning!</strong>
                                        <?= $message; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <?php $this->session->flashdata('pesan') ?>
                                    <div class="row">
                                        <div class="col-6">

                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    Company
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_company" id="id_company" class="form-control">
                                                        <option value="">- pilih -</option>
                                                        <?php if(isset($allcompany)){ 
                                                            foreach($allcompany as $allcompany_row){ ?>
                                                            <option value="<?= $allcompany_row->id_company; ?>" <?php if($allcompany_row->id_company==$id_company){echo 'selected';}?>><?= $allcompany_row->company.' - '.$allcompany_row->company_branch; ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    Divisi
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_divisi" id="id_divisi" class="form-control">
                                                        <option value="">- pilih -</option>
                                                        <?php if(isset($all_divisi_by)){
                                                            foreach($all_divisi_by as $all_divisi_by_row){ ?>
                                                                <option value="<?= $all_divisi_by_row->kodedivisi; ?>" <?php if($all_divisi_by_row->kodedivisi==$id_divisi){echo 'selected';}?>><?= $all_divisi_by_row->divisi; ?></option>
                                                            <?php } } ?>
                                                    </select>
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    Depratemen
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_dept" id="id_dept" class="form-control">
                                                        <option value="">- pilih -</option>
                                                        <?php if(isset($all_dept_by)){
                                                            foreach($all_dept_by as $all_dept_by_row){ ?>
                                                                <option value="<?= $all_dept_by_row->deptid; ?>" <?php if($all_dept_by_row->deptid==$id_dept){echo 'selected';}?>><?= $all_dept_by_row->deptabbr; ?></option>
                                                            <?php } } ?>
                                                    </select>
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    Depratemen - Bagian
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="id_bagian" id="id_bagian" class="form-control">
                                                        <option value="">- pilih -</option>
                                                        <?php if(isset($all_bagian_by)){
                                                            foreach($all_bagian_by as $all_bagian_by_row){ ?>
                                                                <option value="<?= $all_bagian_by_row->bagianid; ?>" <?php if($all_bagian_by_row->bagianid==$id_bagian){echo 'selected';}?>><?= $all_bagian_by_row->bagianabbr; ?></option>
                                                            <?php } } ?>
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-6">

                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    User Level
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="hidden" class="form-control" id="leveluserid" placeholder="" value="<?= $id; ?>" name="leveluserid">
                                                    <input type="hidden" class="form-control" id="leveluserid_audit" placeholder="" value="<?= $lvid_audit; ?>" name="leveluserid_audit">
                                                    <input type="text" class="form-control" id="levelusernm" placeholder="Nama Level User" value="<?php if(isset($message)){echo set_value('levelusernm');}else{echo $levelnm;}?>" name="levelusernm">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    Akses Bagian <?php if(isset($list_bagian)){ echo '1'; }else{ echo '2'; } ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="bagian_akses[]" id="bagian_akses" class="bagian_akses form-control select2" multiple="multiple" data-placeholder="" style="width: 100%;" required="required">
                                                        <?php if($aksi != 'aksi_add'){ 
                                                            foreach($list_bagian as $list_bagian_row){ ?>
                                                              <option value="<?= $list_bagian_row->bagianabbr; ?>" <?php foreach($arr_bagian_akses as $arr_bagian_akses_item){if($arr_bagian_akses_item==$list_bagian_row->bagianabbr){echo 'selected';}}?>><?= $list_bagian_row->bagianabbr; ?></option>
                                                        <?php } }else{ 
                                                            foreach($list_bagian as $list_bagian_row){ ?>
                                                                <option value="<?= $list_bagian_row->bagianabbr; ?>"><?= $list_bagian_row->bagianabbr; ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    Akses Data
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-inline-block mr-2">
                                                            <fieldset>
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="" name="ori_akses" id="ori_akses" <?php if($ori_akses=='1'){ echo 'checked'; } ?>>
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span>Data Original</span>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                        <li class="d-inline-block mr-2">
                                                            <fieldset>
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" value="" name="audit_akses" id="audit_akses" <?php if($audit_akses=='1'){ echo 'checked'; } ?>>
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span>Data Audit</span>
                                                                </div>
                                                            </fieldset>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div> 
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row match-height">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header mb-1">
                                <h4 class="card-title">BUTTON AKSES</h4>
                            </div>
                            <hr>
                            <div class="card-content">
                                <ul>
                                    <li>
                                        <div class="mt-1 pb-1">
                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                <h6 class="filter-title mb-0 mr-2">FORM</h6>
                                                <input type="checkbox" class='CheckButton' onClick='toggle(this)'>
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-check"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <ul class="list-unstyled">
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="" id="btn_simpan" name="btn_create" class="CheckButton" <?php if($btn_create=='1'){echo 'checked';}?>>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span>
                                                        Create Detail Laporan
                                                    </span>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="" id="btn_update" name="btn_update" class="CheckButton" <?php if($btn_update=='1'){echo 'checked';}?>>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span>
                                                        Update Detail Laporan
                                                    </span>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="" id="btn_delete" name="btn_delete" class="CheckButton" <?php if($btn_delete=='1'){echo 'checked';}?>>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span>
                                                        Delete Detail Laporan
                                                    </span>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="" id="btn_complete" name="btn_complete" class="CheckButton" <?php if($btn_complete=='1'){echo 'checked';}?>>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span>
                                                        Complete Detail Laporan
                                                    </span>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="" id="btn_export_excel" name="btn_export_excel" class="CheckButton" <?php if($btn_export_excel=='1'){echo 'checked';}?>>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span>
                                                        Export to excel
                                                    </span>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="" id="btn_export_pdf" name="btn_export_pdf" class="CheckButton" <?php if($btn_export_pdf=='1'){echo 'checked';}?>>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span>
                                                        Export to pdf
                                                    </span>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="" id="btn_delete_dh" name="btn_delete_dh" class="CheckButton" <?php if($btn_delete_dh=='1'){echo 'checked';}?>>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span>
                                                        Delete Data Harian
                                                    </span>
                                                </span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="" id="btn_restore" name="btn_restore" class="CheckButton" <?php if($btn_restore=='1'){echo 'checked';}?>>
                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span>
                                                        Restore Laporan
                                                    </span>
                                                </span>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header mb-1">
                                <h4 class="card-title">MENU AKSES</h4>
                            </div>
                            <hr>
                            <div class="card-content">
                                <?php if(!empty($allmenu)){ 
                                    $nomn = 0; 
                                    foreach($allmenu as $dtmenu){ 
                                        $nomn++; ?>
                                        <ul>
                                            <?php if(isset($dtmenu->children)){ ?>
                                                <li>
                                                    <div class="mt-1 pb-1">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <h6 class="filter-title mb-0 mr-2"><?= $dtmenu->menunm ?></h6>
                                                            <input type="checkbox" id="<?= "CheckMenu".$nomn ?>" class="<?= "CheckMenu".$nomn ?>" onClick='toggle(this)' <?php if(isset($dtmenu->children_byid1)){ foreach($dtmenu->children_byid1 as $child_byid1){if($dtmenu->menuid==$child_byid1->menuid){ echo 'checked'; } } } ?>>
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <?php if(isset($dtmenu->children)){ ?>
                                                        <ul>
                                                            <?php foreach($dtmenu->children as $child){
                                                                if(isset($child->children2)){ ?>
                                                                    <li><?= $child->submenunm; ?>
                                                                        <ul>
                                                                            <?php foreach($child->children2 as $child2){
                                                                                if(isset($child2->children3)){ ?>
                                                                                    <li>
                                                                                        <?= $child2->submenu2nm; ?>
                                                                                        <ul>
                                                                                            <?php foreach($child2->children3 as $child3){ ?>
                                                                                                <li>
                                                                                                    <span class="vs-checkbox-con vs-checkbox-primary">
                                                                                                        <input type="checkbox" id="submenu3" name="submenu[]" class="<?= "CheckMenu".$nomn ?>" value="<?= $dtmenu->menuid.'/'.$child->submenuid.'/'.$child2->submenu2id .'/'.$child3->submenu3id?>" <?php foreach($child3->children_byid4 as $child_byid4){if($child3->submenu3id==$child_byid4->submenu3id){echo 'checked';}}?>>
                                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                                            <span class="vs-checkbox--check">
                                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                                            </span>
                                                                                                        </span>
                                                                                                        <span>
                                                                                                            <?= $child3->submenu3nm; ?>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </li>
                                                                                            <?php } ?>
                                                                                        </ul>
                                                                                    </li>
                                                                                <?php }else{ ?>
                                                                                    <li>
                                                                                        <span class="vs-checkbox-con vs-checkbox-primary">
                                                                                            <input type="checkbox" id="submenu" name="submenu[]" class="<?= "CheckMenu".$nomn ?>" value="<?= $dtmenu->menuid.'/'.$child->submenuid.'/'.$child2->submenu2id; ?>" <?php if(isset($child2->children_byid3)){ foreach($child2->children_byid3 as $child_byid3){if($child2->submenu2id==$child_byid3->submenu2id){ echo 'checked'; } } } ?>>
                                                                                            <span class="vs-checkbox vs-checkbox-sm">
                                                                                                <span class="vs-checkbox--check">
                                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                                </span>
                                                                                            </span>
                                                                                            <span>
                                                                                                <?= $child2->submenu2nm; ?>
                                                                                            </span>
                                                                                        </span>
                                                                                    </li>
                                                                                <?php } 
                                                                            } ?>
                                                                        </ul>
                                                                    </li>
                                                                <?php }else{ ?>
                                                                    <li>
                                                                        <span class="vs-checkbox-con vs-checkbox-primary">
                                                                            <input type="checkbox" id="submenu" name="submenu[]" class="<?= "CheckMenu".$nomn ?>" value="<?= $dtmenu->menuid.'/'.$child->submenuid; ?>" <?php if(isset($child->children_byid2)){ foreach($child->children_byid2 as $child_byid2){if($child->submenuid==$child_byid2->submenuid){ echo 'checked'; } } } ?>>
                                                                            <span class="vs-checkbox vs-checkbox-sm">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                            <span>
                                                                                <?= $child->submenunm; ?>
                                                                            </span>
                                                                        </span>
                                                                    </li>
                                                                <?php } 
                                                            } ?>
                                                        </ul>
                                                    <?php } ?>
                                                </li>
                                            <?php }else{ ?>
                                                <li>
                                                    <div class="mt-1 pb-1">
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <h6 class="filter-title mb-0 mr-2"><?= $dtmenu->menunm ?></h6>
                                                            <input type="checkbox" id="<?= "CheckMenu".$nomn ?>" class="<?= "CheckMenu".$nomn ?>" onClick='toggle(this)' value="<?= $dtmenu->menuid; ?>" name="submenu[]" <?php foreach($dtmenu->children_byid1 as $child_byid1){if($dtmenu->menuid==$child_byid1->menuid){echo 'checked';}}?>>
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } 
                                } ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header mb-1">
                                <h4 class="card-title">FORM AKSES</h4>
                            </div>
                            <hr>
                            <div class="card-content">
                                <?php if(!empty($allform)){
                                    $no=0; 
                                    foreach($allform as $dtform){ 
                                        $no++; ?>
                                        <ul>
                                            <?php if(isset($dtform->children)){ ?>
                                                <li>
                                                    <hr>
                                                    <div class="mt-1 pb-1">
                                                        <ul class="list-unstyled">
                                                            <li class="d-inline-block">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <h6 class="filter-title mr-1"><?= $dtform->formjnsnm ?></h6>
                                                                    <input type="checkbox" id="<?= "checkAllForm".$no ?>" class="<?= "checkAllForm".$no ?>" onClick="toggle(this)" <?php foreach($dtform->form_byid1 as $form_byid1){if($dtform->formjnsid==$form_byid1->formjnsid){echo 'checked';}}?>>
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </li>
                                                            <span class="pull-right">
                                                                <li class="d-inline-block">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <h6 class="filter-title ml-1">CR&nbsp;</h6>
                                                                        <input type="checkbox" id="<?= "checkAllFormCreate".$no ?>" class="<?= "checkAllFormCreate".$no ?>" onClick="toggle(this)">
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </li>

                                                                <li class="d-inline-block">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <h6 class="filter-title ml-1">U&nbsp;</h6>
                                                                        <input type="checkbox" id="<?= "checkAllFormUpdate".$no ?>" class="<?= "checkAllFormUpdate".$no ?>" onClick="toggle(this)">
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </li>

                                                                <li class="d-inline-block">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <h6 class="filter-title ml-1">D&nbsp;</h6>
                                                                        <input type="checkbox" id="<?= "checkAllFormDelete".$no ?>" class="<?= "checkAllFormDelete".$no ?>" onClick="toggle(this)">
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </li>

                                                                <li class="d-inline-block">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <h6 class="filter-title ml-1">Xls&nbsp;</h6>
                                                                        <input type="checkbox" id="<?= "checkAllFormExcel".$no ?>" class="<?= "checkAllFormExcel".$no ?>" onClick="toggle(this)">
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                            </span>
                                                        </ul>
                                                    </div>
                                                    <ul>
                                                        <?php foreach($dtform->children as $childform){ 
                                                            if(isset($childform->children2)){ ?> 
                                                                <li>
                                                                    <h6 class="filter-title mr-1"><?= $childform->formkategorinm ?></h6>
                                                                    <ul>
                                                                        <?php foreach($childform->children2 as $childform2){
                                                                            if(isset($childform2->children3)){ ?>
                                                                                <li>
                                                                                    <h6 class="filter-title mr-1"><?= $childform2->formkategori2nm ?></h6>
                                                                                    <ul>
                                                                                        <?php foreach($childform2->children3 as $childform3){ ?>

                                                                                            <li>
                                                                                                <ul class="list-unstyled">
                                                                                                    <li class="d-inline-block">
                                                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                            <input type="checkbox" id="formid" name="formid[]" class="<?= "checkAllForm".$no ?>" value="<?php if(!isset($childform3->form_byid4)){echo $childform3->formid.'/'.$childform3->formjnsid.'/'.$childform3->formkategoriid.'/'.$childform3->formkategori2id.'////';}else{if(empty($childform3->form_byid4)){echo $childform3->formid.'/'.$childform3->formjnsid.'/'.$childform3->formkategoriid.'/'.$childform3->formkategori2id.'////';}else{foreach($childform3->form_byid4 as $form_byid4){echo $childform3->formid.'/'.$childform3->formjnsid.'/'.$childform3->formkategoriid.'/'.$childform3->formkategori2id.'/'.$form_byid4->form_create.'/'.$form_byid4->form_update.'/'.$form_byid4->form_delete.'/'.$form_byid4->form_excel;}}}?>" <?php foreach($childform3->form_byid4 as $form_byid4){if($childform3->formid==$form_byid4->formid){echo 'checked';}}?>>
                                                                                                            <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                <span class="vs-checkbox--check">
                                                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                                                </span>
                                                                                                            </span>
                                                                                                            <span>
                                                                                                                <?= $childform3->formnm.'-'.$childform3->formversi; ?>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </li>
                                                                                                    <span class="pull-right">
                                                                                                        <li class="d-inline-block">
                                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                <span class="filter-title ml-1">CR&nbsp;</span>
                                                                                                                <input type="checkbox"name="form_create[]" class="<?= "checkAllFormCreate".$no ?>" value="chk_create" <?php foreach($childform3->form_byid4 as $form_byid4){if($form_byid4->form_create=='1'){echo 'checked';}}?>>
                                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                    <span class="vs-checkbox--check">
                                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                                    </span>
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </li>

                                                                                                        <li class="d-inline-block">
                                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                <span class="filter-title ml-1">U&nbsp;</span>
                                                                                                                <input type="checkbox" name="form_update[]" class="<?= "checkAllFormUpdate".$no ?>" value="chk_update" <?php foreach($childform3->form_byid4 as $form_byid4){if($form_byid4->form_update=='1'){echo 'checked';}}?>>
                                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                    <span class="vs-checkbox--check">
                                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                                    </span>
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </li>

                                                                                                        <li class="d-inline-block">
                                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                <span class="filter-title ml-1">D&nbsp;</span>
                                                                                                                <input type="checkbox" name="form_delete[]" class="<?= "checkAllFormDelete".$no ?>" value="chk_delete" <?php foreach($childform3->form_byid4 as $form_byid4){if($form_byid4->form_delete=='1'){echo 'checked';}}?>>
                                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                    <span class="vs-checkbox--check">
                                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                                    </span>
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </li>

                                                                                                        <li class="d-inline-block">
                                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                <span class="filter-title ml-1">Xls&nbsp;</span>
                                                                                                                <input type="checkbox"name="form_excel[]" class="<?= "checkAllFormExcel".$no ?>" value="chk_excel" <?php foreach($childform3->form_byid4 as $form_byid4){if($form_byid4->form_excel=='1'){echo 'checked';}}?>>
                                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                    <span class="vs-checkbox--check">
                                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                                    </span>
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                    </span>
                                                                                                </ul>
                                                                                            </li>
                                                                                        <?php } ?>
                                                                                    </ul>
                                                                                </li>
                                                                            <?php }else{ ?>
                                                                                <li>
                                                                                    <h6 class="filter-title mr-1"><?= $childform2->formkategori2nm ?></h6>
                                                                                </li>
                                                                            <?php } 
                                                                        } ?>
                                                                    </ul>
                                                                </li>
                                                            <?php }elseif(isset($childform->children4)){ ?>
                                                                <li>
                                                                    <h6 class="filter-title mr-1"><?= $childform->formkategorinm ?></h6>
                                                                    <ul>
                                                                        <?php foreach($childform->children4 as $dttest2){ ?>
                                                                            <li>
                                                                                <ul class="list-unstyled">
                                                                                    <li class="d-inline-block">
                                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                            <input type="checkbox" id="formid" name="formid[]" class="<?= "checkAllForm".$no ?>" value="<?php if(!isset($dttest2->form_byid5)){echo $dttest2->formid.'/'.$dttest2->formjnsid.'/'.$dttest2->formkategoriid.'/////';}else{ if(empty($dttest2->form_byid5)){echo $dttest2->formid.'/'.$dttest2->formjnsid.'/'.$dttest2->formkategoriid.'/////';}else{foreach($dttest2->form_byid5 as $form_byid5){echo $dttest2->formid.'/'.$dttest2->formjnsid.'/'.$dttest2->formkategoriid.'//'.$form_byid5->form_create.'/'.$form_byid5->form_update.'/'.$form_byid5->form_delete.'/'.$form_byid5->form_excel;}}}?>" <?php foreach($dttest2->form_byid5 as $form_byid5){if($dttest2->formid==$form_byid5->formid){echo 'checked';}}?>>
                                                                                            <span class="vs-checkbox vs-checkbox-sm">
                                                                                                <span class="vs-checkbox--check">
                                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                                </span>
                                                                                            </span>
                                                                                            <span>
                                                                                                <?= $dttest2->formnm.'-'.$dttest2->formversi; ?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <span class="pull-right">
                                                                                        <li class="d-inline-block">
                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                <span class="filter-title ml-1">CR&nbsp;</span>
                                                                                                <input type="checkbox" name="form_create[]" class="<?= "checkAllFormCreate".$no ?>" value="chk_create" <?php foreach($dttest2->form_byid5 as $form_byid5){if($form_byid5->form_create=='1'){echo 'checked';}}?>>
                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                    <span class="vs-checkbox--check">
                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                    </span>
                                                                                                </span>
                                                                                            </div>
                                                                                        </li>

                                                                                        <li class="d-inline-block">
                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                <span class="filter-title ml-1">U&nbsp;</span>
                                                                                                <input type="checkbox" name="form_update[]" class="<?= "checkAllFormUpdate".$no ?>" value="chk_update" <?php foreach($dttest2->form_byid5 as $form_byid5){if($form_byid5->form_update=='1'){echo 'checked';}}?>>
                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                    <span class="vs-checkbox--check">
                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                    </span>
                                                                                                </span>
                                                                                            </div>
                                                                                        </li>

                                                                                        <li class="d-inline-block">
                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                <span class="filter-title ml-1">D&nbsp;</span>
                                                                                                <input type="checkbox" name="form_delete[]" class="<?= "checkAllFormDelete".$no ?>" value="chk_delete" <?php foreach($dttest2->form_byid5 as $form_byid5){if($form_byid5->form_delete=='1'){echo 'checked';}}?>>
                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                    <span class="vs-checkbox--check">
                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                    </span>
                                                                                                </span>
                                                                                            </div>
                                                                                        </li>

                                                                                        <li class="d-inline-block">
                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                <span class="filter-title ml-1">Xls&nbsp;</span>
                                                                                                <input type="checkbox" name="form_excel[]" class="<?= "checkAllFormExcel".$no ?>" value="chk_excel" <?php foreach($dttest2->form_byid5 as $form_byid5){if($form_byid5->form_excel=='1'){echo 'checked';}}?>>
                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                    <span class="vs-checkbox--check">
                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                    </span>
                                                                                                </span>
                                                                                            </div>
                                                                                        </li>
                                                                                    </span>
                                                                                </ul>
                                                                            </li>
                                                                        <?php } ?>
                                                                    </ul>
                                                                </li>
                                                            <?php }else{ ?>
                                                                <li>
                                                                    <h6 class="filter-title mr-1"><?= $childform->formkategorinm?></h6>
                                                                </li>
                                                            <?php } 
                                                        } ?>
                                                    </ul>
                                                </li>
                                                <?php }elseif(isset($dtform->children5)){ ?>
                                                    <li>
                                                        <div class="mt-1 pb-1">
                                                            <ul class="list-unstyled">
                                                                <li class="d-inline-block">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <h6 class="filter-title mr-1"><?= $dtform->formjnsnm ?></h6>
                                                                        <input type="checkbox" id="<?= "checkAllForm".$no ?>" class="<?= "checkAllForm2".$no ?>" onClick="toggle(this)" <?php if(isset($dtform->form_byid6)){ foreach($dtform->form_byid6 as $form_byid6){if($dtform->formjnsid==$form_byid6->formjnsid){ echo 'checked'; } } } ?>>
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                                <span class="pull-right">
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title ml-1">CR&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAllFormCreate".$no ?>" class="<?= "checkAllForm2Create".$no ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>

                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title ml-1">U&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAllFormUpdate".$no ?>" class="<?= "checkAllForm2Update".$no ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>

                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title ml-1">D&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAllFormDelete".$no ?>" class="<?= "checkAllForm2Delete".$no ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>

                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title ml-1">Xls&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAllFormExcel".$no ?>" class="<?= "checkAllForm2Excel".$no ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                </span>
                                                            </ul>
                                                        </div>
                                                        
                                                        <ul>
                                                            <?php foreach($dtform->children5 as $dttest){ ?>
                                                                <li>
                                                                    <ul class="list-unstyled">
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <input type="checkbox" id="formid" name="formid[]" class="<?= "checkAllForm2".$no ?>"
                                                                                    value="<?php 
                                                                                    if(!isset($dttest->form_byid7)){
                                                                                        echo $dttest->formid.'/'.$dttest->formjnsid.'//////';
                                                                                    }else{
                                                                                        if(empty($dttest->form_byid7)){
                                                                                            echo $dttest->formid.'/'.$dttest->formjnsid.'//////';
                                                                                        }else{
                                                                                            foreach($dttest->form_byid7 as $form_byid7){
                                                                                                echo $dttest->formid.'/'.$dttest->formjnsid.'///'.$form_byid7->form_create.'/'.$form_byid7->form_update.'/'.$form_byid7->form_delete.'/'.$form_byid7->form_excel;
                                                                                            }
                                                                                        }
                                                                                    }?>" <?php if(isset($dttest->form_byid7)){foreach($dttest->form_byid7 as $form_byid7){if($dttest->formid==$form_byid7->formid){echo 'checked';}}}?>>
                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                                <span>
                                                                                    <?= $dttest->formnm.'-'.$dttest->formversi; ?>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <span class="pull-right">
                                                                            <li class="d-inline-block">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <span class="filter-title ml-1">CR&nbsp;</span>
                                                                                    <input type="checkbox" name="form_create[]" class="<?= "checkAllForm2Create".$no ?>" value="chk_create" <?php if(isset($dttest->form_byid7)){foreach($dttest->form_byid7 as $form_byid7){if($form_byid7->form_create=='1'){echo 'checked';}}}?>>
                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </li>

                                                                            <li class="d-inline-block">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <span class="filter-title ml-1">U&nbsp;</span>
                                                                                    <input type="checkbox" name="form_update[]" class="<?= "checkAllForm2Update".$no ?>" value="chk_update" <?php if(isset($dttest->form_byid7)){foreach($dttest->form_byid7 as $form_byid7){if($form_byid7->form_update=='1'){echo 'checked';}}}?>>
                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </li>

                                                                            <li class="d-inline-block">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <span class="filter-title ml-1">D&nbsp;</span>
                                                                                    <input type="checkbox" name="form_delete[]" class="<?= "checkAllForm2Delete".$no ?>" value="chk_delete" <?php if(isset($dttest->form_byid7)){foreach($dttest->form_byid7 as $form_byid7){if($form_byid7->form_delete=='1'){echo 'checked';}}}?>>
                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </li>

                                                                            <li class="d-inline-block">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <span class="filter-title ml-1">Xls&nbsp;</span>
                                                                                    <input type="checkbox" name="form_excel[]" class="<?= "checkAllForm2Excel".$no ?>" value="chk_excel" <?php if(isset($dttest->form_byid7)){foreach($dttest->form_byid7 as $form_byid7){if($form_byid7->form_excel=='1'){echo 'checked';}}}?>>
                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                </div>
                                                                            </li>
                                                                        </span>
                                                                    </ul>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                <?php }else{ ?>
                                                    <li>
                                                        <div class="mt-1 pb-1">
                                                            <ul class="list-unstyled">
                                                                <li class="d-inline-block">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <h6 class="filter-title mr-1"><?= $dtform->formjnsnm ?></h6>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } 
                                    } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header mb-1">
                                    <h4 class="card-title">APPROVAL AKSES</h4>
                                </div>
                                <hr>
                                <div class="card-content">
                                    <?php if(!empty($allapp)){ 
                                        $z = -1; 
                                        $nmb = 0; 

                                        foreach ($allapp as $dtapp){ 
                                            $nmb++; ?>
                                            <ul>
                                                <?php if(isset($dtapp->children)){ ?>
                                                    <li>
                                                        <hr>
                                                        <div class="mt-1 pb-1">
                                                            <ul class="list-unstyled">
                                                                <li class="d-inline-block">
                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                        <h6 class="filter-title mr-1"><?= $dtapp->formjnsnm; ?></h6>
                                                                        <input type="checkbox" id="<?= "checkAllApp".$nmb ?>" class="<?= "checkAllApp".$nmb ?>" onClick="toggle(this)" <?php if(isset($dtapp->app_byid1)){ foreach($dtapp->app_byid1 as $app_byid1){if($dtapp->formjnsid==$app_byid1->formjnsid){echo 'checked';}}}?>>
                                                                        <span class="vs-checkbox">
                                                                            <span class="vs-checkbox--check">
                                                                                <i class="vs-icon feather icon-check"></i>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </li>
                                                                <span class="pull-right">
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">App 1&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App1".$nmb ?>" class="<?= "checkAll_App1".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">2&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App2".$nmb ?>" class="<?= "checkAll_App2".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">3&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App3".$nmb ?>" class="<?= "checkAll_App3".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">4&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App4".$nmb ?>" class="<?= "checkAll_App4".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">5&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App5".$nmb ?>" class="<?= "checkAll_App5".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">6&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App6".$nmb ?>" class="<?= "checkAll_App6".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">7&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App7".$nmb ?>" class="<?= "checkAll_App7".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">8&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App8".$nmb ?>" class="<?= "checkAll_App8".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">9&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App9".$nmb ?>" class="<?= "checkAll_App9".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title">10&nbsp;</h6>
                                                                            <input type="checkbox" id="<?= "checkAll_App10".$nmb ?>" class="<?= "checkAll_App10".$nmb ?>" onClick="toggle(this)">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                </span>
                                                            </ul>
                                                        </div>
                                                        <ul>
                                                            <?php foreach ($dtapp->children as $child){ 
                                                                if(isset($child->children2)){ ?> 
                                                                    <li>
                                                                        <h6 class="filter-title mr-1"><?= $child->formkategorinm ?></h6>
                                                                        <ul>
                                                                            <?php foreach ($child->children2 as $child2){
                                                                                if(isset($child2->children3)){ ?>
                                                                                    <li>
                                                                                        <h6 class="filter-title mr-1"><?= $child2->formkategori2nm ?></h6>
                                                                                        <ul>
                                                                                            <?php foreach ($child2->children3 as $child3){ 
                                                                                                $z++; ?>

                                                                                                <li>
                                                                                                    <ul class="list-unstyled">
                                                                                                        <li class="d-inline-block">
                                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                <input type="checkbox" class="<?= "checkAllApp".$nmb ?>" value="<?= $child3->formid.'/'.$child3->formjnsid.'/'.$child3->formkategoriid.'/'.$child3->formkategori2id?>" name="appformid[<?= $z; ?>]" 
                                                                                                                    <?php $app4id  = '';
                                                                                                                        $n1app1  = '';
                                                                                                                        $n1app2  = '';
                                                                                                                        $n1app3  = '';
                                                                                                                        $n1app4  = '';
                                                                                                                        $n1app5  = '';
                                                                                                                        $n1app6  = '';
                                                                                                                        $n1app7  = '';
                                                                                                                        $n1app8  = '';
                                                                                                                        $n1app9  = '';
                                                                                                                        $n1app10 = '';
                                                                                                                    if(isset($child3->app_byid4)){
                                                                                                                        foreach($child3->app_byid4 as $app_byid4){
                                                                                                                            $app4id  = $app_byid4->formid;
                                                                                                                            $n1app1  = $app_byid4->app1;
                                                                                                                            $n1app2  = $app_byid4->app2;
                                                                                                                            $n1app3  = $app_byid4->app3;
                                                                                                                            $n1app4  = $app_byid4->app4;
                                                                                                                            $n1app5  = $app_byid4->app5;
                                                                                                                            $n1app6  = $app_byid4->app6;
                                                                                                                            $n1app7  = $app_byid4->app7;
                                                                                                                            $n1app8  = $app_byid4->app8;
                                                                                                                            $n1app9  = $app_byid4->app9;
                                                                                                                            $n1app10 = $app_byid4->app10;
                                                                                                                        } 
                                                                                                                    }
                                                                                                                    if($child3->formid==$app4id){echo 'checked';} ?>>
                                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                    <span class="vs-checkbox--check">
                                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                                    </span>
                                                                                                                </span>
                                                                                                                <span>
                                                                                                                    <?= $child3->formnm.'-'.$child3->formversi;?>
                                                                                                                </span>
                                                                                                            </div>
                                                                                                        </li>
                                                                                                        <span class="pull-right">
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">App 1&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App1".$nmb ?>" name="app1[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app1=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">2&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App2".$nmb ?>" name="app2[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app2=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">3&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App3".$nmb ?>" name="app3[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app3=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">4&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App4".$nmb ?>" name="app4[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app4=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">5&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App5".$nmb ?>" name="app5[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app5=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">6&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App6".$nmb ?>" name="app6[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app6=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">7&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App7".$nmb ?>" name="app7[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app7=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">8&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App8".$nmb ?>" name="app8[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app8=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">9&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App9".$nmb ?>" name="app9[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app9=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                            <li class="d-inline-block">
                                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                                    <span class="filter-title">10&nbsp;</span>
                                                                                                                    <input type="checkbox" class="<?= "checkAll_App10".$nmb ?>" name="app10[<?= $z; ?>]" <?php if(($child3->formid==$app4id)&&($n1app10=='1')){echo 'checked';} ?>>
                                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                                        <span class="vs-checkbox--check">
                                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                                        </span>
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </li>
                                                                                                        </span>
                                                                                                    </ul>
                                                                                                </li>
                                                                                            <?php } ?>
                                                                                        </ul>
                                                                                    </li>
                                                                                <?php }else{ ?>
                                                                                    <li>
                                                                                        <h6 class="filter-title mr-1"><?= $childform2->formkategori2nm ?></h6>
                                                                                    </li>
                                                                                <?php } 
                                                                            } ?>
                                                                        </ul>
                                                                    </li>
                                                                <?php }elseif(isset($child->children4)){ ?>
                                                                    <li>
                                                                        <h6 class="filter-title mr-1"><?= $child->formkategorinm ?></h6>
                                                                        <ul>
                                                                            <?php foreach ($child->children4 as $dttest4){ 
                                                                                $z++; ?>
                                                                                <li>
                                                                                    <ul class="list-unstyled">
                                                                                        <li class="d-inline-block">
                                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                <input type="checkbox" class="<?= "checkAllApp".$nmb ?>" value="<?= $dttest4->formid.'/'.$dttest4->formjnsid.'/'.$dttest4->formkategoriid ?>" name="appformid[<?= $z; ?>]" 
                                                                                                    <?php $app5id  = '';
                                                                                                        $n2app1  = '';
                                                                                                        $n2app2  = '';
                                                                                                        $n2app3  = '';
                                                                                                        $n2app4  = '';
                                                                                                        $n2app5  = '';
                                                                                                        $n2app6  = '';
                                                                                                        $n2app7  = '';
                                                                                                        $n2app8  = '';
                                                                                                        $n2app9  = '';
                                                                                                        $n2app10 = '';

                                                                                                        if(isset($dttest4->app_byid5)){
                                                                                                            foreach($dttest4->app_byid5 as $app_byid5){
                                                                                                                $app5id  = $app_byid5->formid;
                                                                                                                $n2app1  = $app_byid5->app1;
                                                                                                                $n2app2  = $app_byid5->app2;
                                                                                                                $n2app3  = $app_byid5->app3;
                                                                                                                $n2app4  = $app_byid5->app4;
                                                                                                                $n2app5  = $app_byid5->app5;
                                                                                                                $n2app6  = $app_byid5->app6;
                                                                                                                $n2app7  = $app_byid5->app7;
                                                                                                                $n2app8  = $app_byid5->app8;
                                                                                                                $n2app9  = $app_byid5->app9;
                                                                                                                $n2app10 = $app_byid5->app10;
                                                                                                            }
                                                                                                        }
                                                                                                        
                                                                                                    if($dttest4->formid==$app5id){echo 'checked';} ?>>
                                                                                                <span class="vs-checkbox vs-checkbox-sm">
                                                                                                    <span class="vs-checkbox--check">
                                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                                    </span>
                                                                                                </span>
                                                                                                <span>
                                                                                                    <?= $dttest4->formnm.'-'.$dttest4->formversi;?>
                                                                                                </span>
                                                                                            </div>
                                                                                        </li>
                                                                                        <span class="pull-right">
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">App 1&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App1".$nmb ?>" name="app1[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app1=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">2&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App2".$nmb ?>" name="app2[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app2=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">3&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App3".$nmb ?>" name="app3[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app3=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">4&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App4".$nmb ?>" name="app4[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app4=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">5&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App5".$nmb ?>" name="app5[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app5=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">6&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App6".$nmb ?>" name="app6[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app6=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">7&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App7".$nmb ?>" name="app7[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app7=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">8&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App8".$nmb ?>" name="app8[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app8=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">9&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App9".$nmb ?>" name="app9[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app9=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                            <li class="d-inline-block">
                                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                                    <span class="filter-title">10&nbsp;</span>
                                                                                                    <input type="checkbox" class="<?= "checkAll_App10".$nmb ?>" name="app10[<?= $z; ?>]" <?php if(($dttest4->formid==$app5id)&&($n2app10=='1')){echo 'checked';} ?>>
                                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                                        <span class="vs-checkbox--check">
                                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            </li>
                                                                                        </span>
                                                                                    </ul>
                                                                                </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </li>
                                                                <?php }else{ ?>
                                                                    <li>
                                                                        <h6 class="filter-title mr-1"><?= $child->formkategorinm ?></h6>
                                                                    </li>
                                                                <?php } 
                                                            } ?>
                                                        </ul>
                                                    </li>
                                                    <?php }elseif(isset($dtapp->children5)){ ?>
                                                        <li>
                                                            <div class="mt-1 pb-1">
                                                                <ul class="list-unstyled">
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title mr-1"><?= $dtapp->formjnsnm ?></h6>
                                                                            <input type="checkbox" id="<?= "checkAllApp".$nmb ?>" class="<?= "checkAllApp2".$nmb ?>" onClick="toggle(this)" <?php if(isset($dtapp->app_byid6)){ foreach($dtapp->app_byid6 as $app_byid6){if($dtapp->appjnsid==$app_byid6->appjnsid){echo 'checked';}}}?>>
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                    
                                                                    <span class="pull-right">
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">App 1&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App1".$nmb ?>" class="<?= "checkAll_App1".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">2&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App2".$nmb ?>" class="<?= "checkAll_App2".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">3&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App3".$nmb ?>" class="<?= "checkAll_App3".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">4&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App4".$nmb ?>" class="<?= "checkAll_App4".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">5&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App5".$nmb ?>" class="<?= "checkAll_App5".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">6&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App6".$nmb ?>" class="<?= "checkAll_App6".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">7&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App7".$nmb ?>" class="<?= "checkAll_App7".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">8&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App8".$nmb ?>" class="<?= "checkAll_App8".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">9&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App9".$nmb ?>" class="<?= "checkAll_App9".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                        <li class="d-inline-block">
                                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                <h6 class="filter-title">10&nbsp;</h6>
                                                                                <input type="checkbox" id="<?= "checkAll_App10".$nmb ?>" class="<?= "checkAll_App10".$nmb ?>" onClick="toggle(this)">
                                                                                <span class="vs-checkbox">
                                                                                    <span class="vs-checkbox--check">
                                                                                        <i class="vs-icon feather icon-check"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </li>
                                                                    </span>
                                                                </ul>
                                                            </div>
                                                            
                                                            <ul>
                                                                <?php foreach ($dtapp->children5 as $dttest3){ 
                                                                    $app7id  = '';
                                                                    $n3app1  = '';
                                                                    $n3app2  = '';
                                                                    $n3app3  = '';
                                                                    $n3app4  = '';
                                                                    $n3app5  = '';
                                                                    $n3app6  = '';
                                                                    $n3app7  = '';
                                                                    $n3app8  = '';
                                                                    $n3app9  = '';
                                                                    $n3app10 = '';

                                                                    if(isset($dttest3->app_byid7)){
                                                                        foreach($dttest3->app_byid7 as $app7_row){
                                                                            $app7id  = $app7_row->formid;
                                                                            $n3app1  = $app7_row->app1;
                                                                            $n3app2  = $app7_row->app2;
                                                                            $n3app3  = $app7_row->app3;
                                                                            $n3app4  = $app7_row->app4;
                                                                            $n3app5  = $app7_row->app5;
                                                                            $n3app6  = $app7_row->app6;
                                                                            $n3app7  = $app7_row->app7;
                                                                            $n3app8  = $app7_row->app8;
                                                                            $n3app9  = $app7_row->app9;
                                                                            $n3app10 = $app7_row->app10;
                                                                        }
                                                                    }

                                                                    $z++; ?>
                                                                    <li>
                                                                        <ul class="list-unstyled">
                                                                            <li class="d-inline-block">
                                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                    <input type="checkbox" class="<?= "checkAllApp2".$nmb ?>" value="<?= $dttest3->formid.'/'.$dttest3->formjnsid ?>" name="appformid[<?= $z; ?>]" <?php if($dttest3->formid==$app7id){echo 'checked';}?>>
                                                                                    <span class="vs-checkbox vs-checkbox-sm">
                                                                                        <span class="vs-checkbox--check">
                                                                                            <i class="vs-icon feather icon-check"></i>
                                                                                        </span>
                                                                                    </span>
                                                                                    <span>
                                                                                        <?= $dttest3->formnm.'-'.$dttest3->formversi;?>
                                                                                    </span>
                                                                                </div>
                                                                            </li>

                                                                            <span class="pull-right">
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">App 1&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App1".$nmb ?>" name="app1[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app1=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">2&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App2".$nmb ?>" name="app2[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app2=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">3&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App3".$nmb ?>" name="app3[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app3=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">4&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App4".$nmb ?>" name="app4[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app4=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">5&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App5".$nmb ?>" name="app5[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app5=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">6&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App6".$nmb ?>" name="app6[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app6=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">7&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App7".$nmb ?>" name="app7[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app7=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">8&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App8".$nmb ?>" name="app8[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app8=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">9&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App9".$nmb ?>" name="app9[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app9=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                                <li class="d-inline-block">
                                                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                                                        <span class="filter-title">10&nbsp;</span>
                                                                                        <input type="checkbox" class="<?= "checkAll_App10".$nmb ?>" name="app10[<?= $z; ?>]" <?php if(($dttest3->formid==$app7id)&&($n3app10=='1')){echo 'checked';} ?>>
                                                                                        <span class="vs-checkbox vs-checkbox-sm">
                                                                                            <span class="vs-checkbox--check">
                                                                                                <i class="vs-icon feather icon-check"></i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </li>
                                                                            </span>
                                                                        </ul>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </li>
                                                    <?php }else{ ?>
                                                        <li>
                                                            <div class="mt-1 pb-1">
                                                                <ul class="list-unstyled">
                                                                    <li class="d-inline-block">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <h6 class="filter-title mr-1"<?= $dtapp->formjnsnm; ?></h6>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } 
                                        } ?>
                                        <input type="hidden" name="dtjml_app" value="<?= $z;?>"/>
                                    </div>
                                </div>
                            </div>                       

                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn bg-gradient-primary btn-block" name="btnSave">Simpan</button>
                            <button type="reset" class="btn bg-gradient-dark btn-block" >Batal</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('.bagian_akses').select2();

        $('#id_company').change(function(){
          var id_company = $(this).val();
            if(id_company.trim()!=''){
                $('#id_divisi').prop('selectedIndex',0);
                $('#id_divisi').find('option').not(':first').remove();
                $('#id_dept').prop('selectedIndex',0);
                $('#id_dept').find('option').not(':first').remove();
                $.ajax({
                    type : "post",
                    url  : "<?= base_url(); ?>index.php/master/C_userlevel/get_opt_divisi",
                    data : { id_company: id_company},
                        success: function(html_divisi){
                            $('#id_divisi').append(html_divisi);
                        }
                });  
            }else{
                $('#id_divisi').prop('selectedIndex',0);
                $('#id_divisi').find('option').not(':first').remove();
                $('#id_dept').prop('selectedIndex',0);
                $('#id_dept').find('option').not(':first').remove();
            }
        });

        $('#id_divisi').change(function(){
            var id_company = $('#id_company').val();
            var id_divisi = $(this).val();
            if(id_divisi.trim()!=''){
                $('#id_dept').prop('selectedIndex',0);
                $('#id_dept').find('option').not(':first').remove();
                $.ajax({
                    type : "post",
                    url  : "<?= base_url(); ?>index.php/master/C_userlevel/get_opt_dept",
                    data : { id_company: id_company, id_divisi: id_divisi},
                        success: function(html_dept){                          
                        $('#id_dept').append(html_dept);
                    }
                });  
            }else{
                $('#id_dept').prop('selectedIndex',0);
                $('#id_dept').find('option').not(':first').remove();
            }
        });

        $('#id_dept').change(function(){
            var id_company = $('#id_company').val();
            var id_divisi = $('#id_divisi').val();
            var id_dept = $(this).val();
            if(id_dept.trim()!=''){
                $('#id_bagian').prop('selectedIndex',0);
                $('#id_bagian').find('option').not(':first').remove();
                $.ajax({
                    type : "post",
                    url  : "<?= base_url(); ?>index.php/master/C_userlevel/get_opt_bagian",
                    data : { id_company: id_company, id_divisi: id_divisi, id_dept: id_dept},
                        success: function(html_bagian){   
                        console.log('html bagian :'+html_bagian);                       
                        $('#id_bagian').append(html_bagian);
                    }
                });  
            }else{
                $('#id_bagian').prop('selectedIndex',0);
                $('#id_bagian').find('option').not(':first').remove();
            }
        });

        $(document).on('keyup', "input[type=text]", function (){
            $(this).val(function (_, val){
                return val.toUpperCase();
            });
        });

        $('input[type="checkbox"]').on('change', function(){
            var that = $(this);
            var chk_val = $(this).val();
            if(chk_val=='chk_create'){
                if($(this).prop('checked')==true){ 
                    var col_formid     = that.closest('ul').find("#formid");
                    var val_formid     = that.closest('ul').find("#formid").val();
                    var arr_formid     = val_formid.split("/");
                    var val_formid_new = arr_formid[0]+'/'+arr_formid[1]+'/'+arr_formid[2]+'/'+arr_formid[3]+'/1/'+arr_formid[5]+'/'+arr_formid[6]+'/'+arr_formid[7];
                    console.log(val_formid_new);
                    col_formid.val(val_formid_new);
                }else{
                    var col_formid     = that.closest('ul').find("#formid");
                    var val_formid     = that.closest('ul').find("#formid").val();
                    var arr_formid     = val_formid.split("/");
                    var val_formid_new = arr_formid[0]+'/'+arr_formid[1]+'/'+arr_formid[2]+'/'+arr_formid[3]+'//'+arr_formid[5]+'/'+arr_formid[6]+'/'+arr_formid[7];
                    console.log(val_formid_new);
                    col_formid.val(val_formid_new);
                }
            }else if(chk_val=='chk_update'){
                if($(this).prop('checked')==true){ 
                    var col_formid     = that.closest('ul').find("#formid");
                    var val_formid     = that.closest('ul').find("#formid").val();
                    var arr_formid     = val_formid.split("/");
                    var val_formid_new = arr_formid[0]+'/'+arr_formid[1]+'/'+arr_formid[2]+'/'+arr_formid[3]+'/'+arr_formid[4]+'/1/'+arr_formid[6]+'/'+arr_formid[7];
                    console.log(val_formid_new);
                    col_formid.val(val_formid_new);
                }else{
                    var col_formid     = that.closest('ul').find("#formid");
                    var val_formid     = that.closest('ul').find("#formid").val();
                    var arr_formid     = val_formid.split("/");
                    var val_formid_new = arr_formid[0]+'/'+arr_formid[1]+'/'+arr_formid[2]+'/'+arr_formid[3]+'/'+arr_formid[4]+'//'+arr_formid[6]+'/'+arr_formid[7];
                    console.log(val_formid_new);
                    col_formid.val(val_formid_new);
                }
            }else if(chk_val=='chk_delete'){
                if($(this).prop('checked')==true){ 
                    var col_formid     = that.closest('ul').find("#formid");
                    var val_formid     = that.closest('ul').find("#formid").val();
                    var arr_formid     = val_formid.split("/");
                    var val_formid_new = arr_formid[0]+'/'+arr_formid[1]+'/'+arr_formid[2]+'/'+arr_formid[3]+'/'+arr_formid[4]+'/'+arr_formid[5]+'/1/'+arr_formid[7];
                    console.log(val_formid_new);
                    col_formid.val(val_formid_new);
                }else{
                    var col_formid     = that.closest('ul').find("#formid");
                    var val_formid     = that.closest('ul').find("#formid").val();
                    var arr_formid     = val_formid.split("/");
                    var val_formid_new = arr_formid[0]+'/'+arr_formid[1]+'/'+arr_formid[2]+'/'+arr_formid[3]+'/'+arr_formid[4]+'/'+arr_formid[5]+'//'+arr_formid[7];
                    console.log(val_formid_new);
                    col_formid.val(val_formid_new);
                }
            }else if(chk_val=='chk_excel'){
                if($(this).prop('checked')==true){ 
                    var col_formid     = that.closest('ul').find("#formid");
                    var val_formid     = that.closest('ul').find("#formid").val();
                    var arr_formid     = val_formid.split("/");
                    var val_formid_new = arr_formid[0]+'/'+arr_formid[1]+'/'+arr_formid[2]+'/'+arr_formid[3]+'/'+arr_formid[4]+'/'+arr_formid[5]+'/'+arr_formid[6]+'/1';
                    console.log(val_formid_new);
                    col_formid.val(val_formid_new);
                }else{
                    var col_formid     = that.closest('ul').find("#formid");
                    var val_formid     = that.closest('ul').find("#formid").val();
                    var arr_formid     = val_formid.split("/");
                    var val_formid_new = arr_formid[0]+'/'+arr_formid[1]+'/'+arr_formid[2]+'/'+arr_formid[3]+'/'+arr_formid[4]+'/'+arr_formid[5]+'/'+arr_formid[6]+'/';
                    console.log(val_formid_new);
                    col_formid.val(val_formid_new);
                }
            }
        });
    });
</script>

<script type="text/javascript">
    function toggle(source){
        var aInputs = document.getElementsByTagName('input');
        for (var i=0;i<aInputs.length;i++){
            if(aInputs[i] != source && aInputs[i].className == source.className){
                aInputs[i].checked = source.checked;
                var event = new Event('change');
                aInputs[i].dispatchEvent(event);
            }
        }
    }
 </script>

<?php $this->load->view('template/footbarend'); ?>