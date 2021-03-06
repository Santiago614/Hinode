<?php
session_start();
if (isset($_SESSION['correo'])) {
  require '../dao/conexion.php';
  //Consulta para mostrar las categorias
  $sqlCategoria = "SELECT idCategoria,nombreCategoria FROM tblcategoria";
  $consultaCategoria = $pdo->prepare($sqlCategoria);
  $consultaCategoria->execute();
  $resultadoCategoria = $consultaCategoria->fetchAll();

  //Consulr el id del usuario logueado
  $sqlDocumento = "SELECT nombresUsuario,apellidosUsuario,documentoIdentidad FROM tblusuario WHERE correoUsuario=:correo";
  $consultaDocumento = $pdo->prepare($sqlDocumento);
  $consultaDocumento->bindValue(":correo", $_SESSION['correo']);
  $consultaDocumento->execute();
  $resultadoDocumento = $consultaDocumento->fetch();

  //Mostrar productos agregados
  $sqlProducto = "SELECT PR.idProducto,PR.nombreProducto,PR.descripcionProducto,PR.precioProducto,PR.imagenProducto,CA.nombreCategoria 
  FROM tblproducto as PR 
  INNER JOIN tblcategoria as CA ON CA.idCategoria=PR.categoriaProducto";
  $consultaProducto = $pdo->prepare($sqlProducto);
  $consultaProducto->execute();
  $resultadoProducto = $consultaProducto->fetchAll();
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>HINODE - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
    <link href="../assets/img/faviconHinode.png" rel="icon">
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Edici??n Productos </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $resultadoDocumento['nombresUsuario'] . " " . $resultadoDocumento['apellidosUsuario']; ?></span>
                  <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar Sesi??n
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Formulario para registrar productos-->
            <?php if (@!$_POST['idProducto']) { ?>
              <div class="cont-form-crearPubli">
                <div class="card">
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h3 class="mb-0">Agregar Producto</h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-body form-crearPubli">
                    <form action="../controller/crearProducto.php" method="POST" enctype="multipart/form-data">
                      <h6 class="heading-small text-muted mb-4">
                        ??Cu??ntale a la gente lo que quieres ofrecer!
                      </h6>
                      <div class="pl-lg-4">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">T??tulo</label>
                              <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre Producto" value="" required />
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Descripci??n</label>
                              <input type="text" id="input-username" name="descripcion" class="form-control" placeholder="Descripci??n" maxlength="5000" value="" required />
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Costo</label>
                              <input type="number" id="input-username" name="costo" class="form-control" placeholder="Costo" max="999999999" value="" required />
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-email">Categoria</label>
                              <select name="categoria" class="form-control" required>
                                <option value="" disabled selected>
                                  Seleccione una categoria del producto
                                </option>
                                <?php
                                foreach ($resultadoCategoria as $datosCategoria) { ?>
                                  <option value="<?php echo $datosCategoria['idCategoria']; ?>">
                                    <?php echo $datosCategoria['nombreCategoria']; ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Imagen</label>
                              <input type="file" id="input-username" name="imagen" id="file" class="form-control-file" accept="image/x-png,image/jpeg" required />
                              <div class="description">
                                <!-- <br>
                                        limite de 2048MB por im??genes -->
                                <br />
                                Tipos permitidos: jpeg, png, jpg
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="hidden" id="usu" name="usuario" class="form-control" placeholder="Usuario" value="<?php echo $resultadoDocumento['documentoIdentidad']; ?>" />
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary btn-xs" type="submit" name="subir">
                          Publicar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php } else {
              $idProducto = $_POST['idProducto'];
              $sqlMostrarProducto = "SELECT PR.idProducto,PR.nombreProducto,PR.descripcionProducto,PR.precioProducto,CA.idCategoria,CA.nombreCategoria 
              FROM tblproducto as PR 
              INNER JOIN tblcategoria as CA ON CA.idCategoria=PR.categoriaProducto
              WHERE PR.idProducto=:idProducto";
              $consultaMostrarProducto = $pdo->prepare($sqlMostrarProducto);
              $consultaMostrarProducto->bindValue(":idProducto", $idProducto);
              $consultaMostrarProducto->execute();
              $resultadoMostrarProducto = $consultaMostrarProducto->fetch();
            ?>
              <div class="cont-form-crearPubli">
                <div class="card">
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h3 class="mb-0">Editar Producto</h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-body form-crearPubli">
                    <form action="../controller/actualizarProducto.php" method="POST">
                      <h6 class="heading-small text-muted mb-4">
                        ??Haz las actualizaciones de tu producto!
                      </h6>
                      <div class="pl-lg-4">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">T??tulo</label>
                              <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre Producto" value="<?php echo $resultadoMostrarProducto['nombreProducto']; ?>" required />
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Descripci??n</label>
                              <input type="text" id="input-username" name="descripcion" class="form-control" placeholder="Descripci??n" maxlength="5000" value="<?php echo $resultadoMostrarProducto['descripcionProducto']; ?>" required />
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Costo</label>
                              <input type="number" id="input-username" name="costo" class="form-control" placeholder="Costo" max="999999999" value="<?php echo $resultadoMostrarProducto['precioProducto'] ?>" required />
                            </div>
                          </div>
                          <input type="hidden" name="idProducto" value="<?php echo $resultadoMostrarProducto['idProducto']; ?>">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-email">Categoria</label>
                              <select name="categoria" class="form-control" required>
                                <option value="<?php echo $resultadoMostrarProducto['idCategoria']; ?>"><?php echo $resultadoMostrarProducto['nombreCategoria']; ?></option>
                                <?php
                                foreach ($resultadoCategoria as $datosCategoria) { ?>
                                  <option value="<?php echo $datosCategoria['idCategoria']; ?>">
                                    <?php echo $datosCategoria['nombreCategoria']; ?>
                                  </option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary btn-xs" type="submit" name="subir">
                          Editar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php } ?>
            <!-- Fin formulario -->
            <br><br>
            <!-- Tabla de productos -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Productos Registrados</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripci??n</th>
                        <th>Precio</th>
                        <th>Categor??a</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($resultadoProducto as $datosProducto) { ?>
                        <tr>
                          <td><img src="../assets/img/<?php echo $datosProducto['imagenProducto'] ?>" alt="" width="90px"></td>
                          <td><?php echo $datosProducto['nombreProducto'] ?></td>
                          <td><?php echo $datosProducto['descripcionProducto'] ?></td>
                          <td><?php echo number_format($datosProducto['precioProducto'], 0, '', '.') ?></td>
                          <td><?php echo $datosProducto['nombreCategoria'] ?></td>
                          <td>
                            <form action="index.php" method="post">
                              <input type="hidden" name="idProducto" value="<?php echo $datosProducto['idProducto'] ?>">
                              <input type="submit" class="btn btn-success" value="Editar">
                            </form>
                          </td>
                          <td>
                            <form action="../controller/eliminarProducto.php" method="post">
                              <input type="hidden" name="idProducto" value="<?php echo $datosProducto['idProducto'] ?>">
                              <input type="submit" class="btn btn-danger" value="Eliminar">
                            </form>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- Fin tabla de productos -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Productos HINODE 2022</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">??Qui??res cerrar sesi??n?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">??</span>
            </button>
          </div>
          <div class="modal-body">
            Seleccionar "Cerrar Sesi??n" si est??s listo para cerrar tu sesi??n.
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">
              Cancelar
            </button>
            <a class="btn btn-primary" href="../controller/cerrarSesion.php">Cerrar Sesi??n</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

  </body>

  </html>
<?php } else {
  echo "<script>alert('??Error! La sesi??n est?? inactiva, verifica e intenta nuevamente');</script>";
  echo "<script> document.location.href='../index.php';</script>";
} ?>