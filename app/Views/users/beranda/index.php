<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Show PRO</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="favicon.ico" rel="icon">
  <link href="favicon.ico" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets'); ?>/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?= base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets'); ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url('assets'); ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url('assets'); ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url('assets'); ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">
          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url(<?= base_url('assets'); ?>/img/slide/slide-1.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Selamat Datang di <span>ShowPro</span></h2>
                <p class="animate__animated animate__fadeInUp">Produk-produk terbaik untuk kebutuhan Anda</p>
              </div>
            </div>
          </div>
          <!-- Slide 2 -->
          <div class="carousel-item" style="background-image: url(<?= base_url('assets'); ?>/img/slide/slide-2.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Promo Terbaik</h2>
                <p class="animate__animated animate__fadeInUp">Dapatkan diskon menarik setiap minggu</p>
              </div>
            </div>
          </div>
          <!-- Slide 3 -->
          <div class="carousel-item" style="background-image: url(<?= base_url('assets'); ?>/img/slide/slide-3.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Kualitas Terjamin</h2>
                <p class="animate__animated animate__fadeInUp">Produk-produk dengan kualitas terbaik</p>
              </div>
            </div>
          </div>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-double-left" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-double-right" aria-hidden="true"></span>
        </a>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <!-- Main Content Section -->
    <section id="products" class="products">
      <div class="container">
        <div class="row">
          
          <div>
            <div class="row">
              <?php foreach ($products as $product) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                  <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="<?= base_url('assets-admin/img/' . $product->gambar_produk); ?>" alt="<?= $product->nama_produk; ?>"></a>
                    <div class="card-body">
                      <h4 class="card-title">
                        <a href="#"><?= $product->nama_produk; ?></a>
                      </h4>
                      <p class="card-text"><?= $product->deskripsi; ?></p>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted">Kategori: <?= $product->kategori_slug; ?></small>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="row">
              <div class="col">
                <?= $pager->links(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>ShowPro</h3>
            <p>
              Bekasi <br>
              Jawa Barat 17535, IND<br><br>
              <strong>Phone:</strong> +62 5589 55488 55<br>
              <strong>Email:</strong> info@ubs.ac.id<br>
            </p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <!-- <h4>Login</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
            </ul> -->
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Login</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
            </ul>
          </div>

          

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>ShowPro</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootstrap-3-one-page-template-free-shuffle/ -->
        Designed by ShowPro
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets'); ?>/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="<?= base_url('assets'); ?>/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets'); ?>/js/main.js"></script>

</body>

</html>
