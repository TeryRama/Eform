<?php $this->load->view('template/headbar'); ?>

<section id="bg-variants">
    <div class="row">
        <div class="col-12 mb-1">
            <h4 class="text-uppercase"><?= $judul ?></h4>
        </div>
    </div>
    <div class="row">
        <?php if (isset($dtforms)) {
            $nom = 1;
            foreach ($dtforms  as $childform) { ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="<?= base_url($ctr . '/' . $aksi . '/' . $childform->formkd . '/' . $childform->formversi) ?>">
                        <div class="card text-white bg-gradient-<?= $bg ?> text-center">
                            <div class="card-content d-flex">
                                <div class="card-body">
                                    <div class="col-lg-12 fonticon-container">
                                        <div class="fonticon-wrap">
                                            <i class="fa fa-file-text-o"></i>
                                        </div>
                                        <h4 class="card-title text-white mt-3">
                                            <strong>
                                                <?= $nom++ . '. ' ?>
                                                <?= $childform->formnm . '-' . $childform->formversi ?>
                                            </strong>
                                        </h4>
                                        <p class="card-text"><?= $childform->formjudul ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php }
        } else { ?>
            <div class="col-xl-12 col-lg-12">
                <div class="alert alert-<?= $bg ?> mb-2 text-center" role="alert">
                    <strong>Data Tidak Tersedia!</strong>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php $this->load->view('template/footbar'); ?>
<?php $this->load->view('template/footbarend'); ?>