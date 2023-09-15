<?php $this->load->view('template/headbar'); ?>

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/css/extensions/swiper.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/css/plugins/extensions/swiper.css">

<!-- Info boxes -->
<div class="row">
  <div class="col-md-12" style="text-align:center;">
    <div class="card-content mt-1 mb-1">
      <div class=" card-dashboard">
        <?php

        function tanggal_indo($tanggal, $cetak_hari = false)
        {
          $hari = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
          );

          $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
          );
          $split    = explode('-', $tanggal);
          $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

          if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
          }
          return $tgl_indo;
        }
        ?>

        <marquee direction="left" class="bg-default p-1" scrollamount="9" style="background-color: #c2c6dc; border-radius: 5px;">
          <?php
          $list_quote =
            [
              'Mau pulang selamat? Utamakan keselamatan kerja',
              'Berhati-hatilah dalam bekerja karena keluarga menunggu di rumah',
              'Hentikan kecelakaan, sebelum ia menghentikan kita',
              'Jadikan hari ini sebagai hari terbaik, dengan bekerja selamat',
              'Safety adalah gerbang utama menuju kesuksesan',
              'Aturan keselamatan kerja adalah alat kerja terbaik. Maka patuhilah!',
              'Tiada hari tanpa keselamatan kerja',
              'SELAMAT DAN SUKSES 55 TAHUN SAMBU GROUP',
            ];

          if (isset($jadwal_audit)) {
            foreach ($jadwal_audit as $dtjadwal_auditrow) {
              $jadwal_from    = $dtjadwal_auditrow->jadwal_from;
              $jadwal_to      = $dtjadwal_auditrow->jadwal_to;
              $jadwal_remarks = $dtjadwal_auditrow->jadwal_remarks;

              echo $jadwal_remarks; ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php
              echo 'Tanggal :  ' . $jadwal_from;
              ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php
              echo 's/d Tanggal :  ' . $jadwal_to;
              ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <?php echo '||'; ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            }
          } else {
            echo '<h4 class="font-weight-bold text-uppercase" > <image src="' . base_url("assets/images/date.png") . '" width="25"> ' . tanggal_indo(date('Y-m-d'), true) . ' ~ ' . $list_quote[rand(0, 6)] . '</h4>';
            ?>
          <?php
          }
          ?>
        </marquee>
      </div>
    </div>
  </div>
</div>


<section id="component-swiper-autoplay">
  <div class="card ">
    <div class="card-header">
      <h4 class="card-title"><i class="fa fa-bullhorn"></i> Papan Informasi</h4>
    </div>
    <div class="card-content">
      <div class="card-body">
        <div class="swiper-autoplay swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide"><img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/hut_55_sambu_banner.jpg?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"><img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg1.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg3.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg2.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg4.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg5.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg6.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg7.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg8.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg9.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg10.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg11.png?timestamp=<?= time() ?>" alt="banner"></div>
            <div class="swiper-slide"> <img width="1800" height="700" class="img-fluid" src="<?= base_url(); ?>assets/images/bgdashboard/bg12.png?timestamp=<?= time() ?>" alt="banner"></div>
          </div>
          <!-- Add Pagination -->
          <div class="swiper-pagination"></div>
          <!-- Add Arrows -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- default swiper start -->
<section id="component-swiper-default">
  <div class="swiper-default swiper-container">
  </div>
</section>
<!-- default swiper ends -->

<?php $this->load->view('template/footbar'); ?>

<script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/vendors/js/extensions/swiper.min.js"></script>
<script src="<?= base_url(); ?>assets/admin-vuexy-v4.1/vuexy-html-admin/app-assets/js/scripts/extensions/swiper.js"></script>

<?php $this->load->view('template/footbarend'); ?>