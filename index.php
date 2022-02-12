<?php
require 'dao/conexion.php';
//Consulta para mostrar los productos
$sqlProducto = "SELECT PR.nombreProducto,PR.imagenProducto,PR.descripcionProducto,PR.precioProducto,CA.nombreCategoria 
FROM tblcategoria as CA 
INNER JOIN tblproducto as PR ON CA.idCategoria=PR.categoriaProducto";
$consultaProducto = $pdo->prepare($sqlProducto);
$consultaProducto->execute();
$resultadoProducto = $consultaProducto->fetchAll();

//Consulta para mostrar las categorias
$sqlCategoria = "SELECT nombreCategoria FROM tblcategoria";
$consultaCategoria = $pdo->prepare($sqlCategoria);
$consultaCategoria->execute();
$resultadoCategoria = $consultaCategoria->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>HINODE - Página Principal</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/faviconHinode.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Restaurantly - v3.7.0
  * Template URL: https://bootstrapmade.com/restaurantly-restaurant-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-cente">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Inicio</a></li>
          <li><a class="nav-link scrollto" href="#about">¿Qué es?</a></li>
          <li><a class="nav-link scrollto" href="#menu">Productos</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Bienvenidos a <span>Tu tienda virtual HINODE</span></h1>
          <h2>Aquí encontrarás todos los productos que estás solicitando</h2>
          <h3>Si quieres adquirir alguno de estos productos por favor contactenos a través del número: +57 3177595055</h3>

          <a href="https://api.whatsapp.com/send?phone=573177595055" target="_black"><img src="assets/img/whatsapp.svg" class="iconoWhatsapp" alt=""></a>
        </div>

      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="assets/img/fundadoresHinode.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>¿Qué es HINODE?</h3>
            <p class="fst-italic">
              Hinode es una gran compañía de cosméticos y cuidado de la piel, una de las más importantes de Brasil,
              y brinda una oportunidad para que las personas se beneficien de la venta de sus productos. También cuentan con perfumería, maquillaje y cosméticos.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> "Sin esfuerzo no hay resultado".</li>
              <li><i class="bi bi-check-circle"></i> "Verdaderos líderes inspiran crecimiento".</li>
              <li><i class="bi bi-check-circle"></i> "Más que un equipo, una familia".</li>
            </ul>
            <p>
              Somos el grupo Hinode, grupo en todos los sentidos de la palabra.
              Pensamos juntos para poder pensar en grande. Reunimos ideas, personas y sueños en un solo lugar.
              Luchamos para hacer la diferencia en la vida de cada uno de nosotros y en el mundo.
              Porque cada día es una nueva oportunidad de ganar.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Productos</h2>
          <p>Consulta Nuestros Productos de Calidad</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="*" class="filter-active">Todos</li>
              <?php foreach ($resultadoCategoria as $datosCategoria) { ?>
                <li data-filter=".filter-<?php echo $datosCategoria['nombreCategoria']; ?>"><?php echo $datosCategoria['nombreCategoria']; ?></li>
              <?php } ?>
            </ul>
          </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
          <?php foreach ($resultadoProducto as $datos) { ?>
            <div class="col-lg-6 menu-item filter-<?php echo $datos['nombreCategoria']; ?>">
              <img src="assets/img/<?php echo $datos['imagenProducto']; ?>" class="menu-img" alt="">
              <div class="menu-content">
                <a><?php echo $datos['nombreProducto']; ?></a><span>$<?php echo number_format($datos['precioProducto'], 0, '', '.'); ?></span>
              </div>
              <div class="menu-ingredients">
                <?php echo $datos['descripcionProducto']; ?>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section><!-- End Menu Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Productos HINODE</span></strong>. Todos los derechos reservados 2022
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>