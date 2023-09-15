<?php $this->load->view('template/headbar'); ?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?= $Titel ?></h4>
        </div>
    </div>

    <?php if (!empty($dtforms)) { 
        $no = -1;
        foreach ($dtforms  as $childform) {
            $no++;
            if (isset($createtable[$no])) {
                if ($jml_app[$no] > 0) { ?>
                    <form action="<?php echo base_url('approval/C_approval/approved_all/'.$childform->formkd.'/'.$childform->formversi.'/'.$app_pos[$no]) ?>" id="form1" name="form1" method="post" role="form1" class="form-horizontal" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="alert alert-info">
                                                    <i class="feather icon-bell mr-1 align-middle"></i>
                                                    <span><strong><?php echo $jml_app[$no]; ?> <?php echo $childform->formnm . '-' . $childform->formversi . '  (' . $childform->formjudul . ')' ?></strong></span>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <?php if(isset($createtable[$no])){ echo $createtable[$no]; } ?>
                                            </div>
                                            <div class="col-12" align="right">
                                                <input type="hidden" name="redirect" value="<?= $this->uri->uri_string() ?>" />
                                                <input type="hidden" name="app_by" value="<?php echo $nmlengkap; ?>" />
                                                <input type="hidden" name="personalid" value="<?php echo $personalid; ?>" />
                                                <input type="hidden" name="personalstatus" value="<?php echo $personalstatus; ?>" />
                                                <input type="hidden" name="app_date" value="<?php echo date('Y-m-d'); ?>" />
                                                <input type="hidden" name="app_position" value="<?php echo $app_pos[$no]; ?>" />
                                                <input type="hidden" name="app_form" value="<?php echo $childform->formkd; ?>" />
                                                <button type="submit" class="btn bg-gradient-primary col-3" name="btn_appall" value="btn_appall" onclick="return confirm('Approve Semua Laporan?')">Approve All <?php echo $childform->formnm . '-' . $childform->formversi; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php }
            }
        }
    } ?>
</section>

<?php $this->load->view('template/footbar'); ?>

<script type="text/javascript">
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