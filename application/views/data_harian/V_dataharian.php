<?php $this->load->view('template/headbar'); ?>

<?php foreach($dtfrm as $dt_form){
    $frmjdl  = $dt_form->formjudul;
    $frmefec = date("d-m-Y", strtotime($dt_form->formefective));
    $frmkd   = $dt_form->formkd;
    $frmvrs  = $dt_form->formversi;
    $frmnm   = $dt_form->formnm;
} 
// print_r($frmvrs);
?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?= $Titel ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="text-center mt-3">
                    <h5 class="card-title"><?= $frmjdl;?></h5>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?= $createtable; ?>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <span class="pull-left">Form Efective : <?= $frmefec;?></span>
                                <a href="?#"><span class="pull-right"><?= $frmnm.'-'.$frmvrs;?></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>

<script>
    function confirmDialog() {
        return confirm("ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI?")
    }
</script>

<?php $this->load->view('template/footbarend'); ?>