<?php
session_start();
if (!isset($_SESSION ['usuario'])) {
    header('Location:iniciosesion.php');
}
$usuario = $_SESSION ['usuario'];
?>
<!DOCTYPE html>
<html lang="en" >

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>Inicio</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="../css/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="../css/dist/sweetalert.css">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
    

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="menu.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Star Note</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="menu.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Inicio</span></a>
      </li>
      <!-- Heading -->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item ">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Usuarios</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Gestion de usuarios:</h6>
              <div id="menu">
            <a class="collapse-item" href="gestionusuario.php">Crear usuarios</a>
              </div>
          </div>
        </div>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="../tables.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tablas</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Notificaciónes
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    Esto es una notificación
                  </div>
                </a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $usuario->nombre ?><span id="id" hidden><?= $usuario->id_usuario ?></span></span>
                <img class="img-profile rounded-circle" src="../img/perfil.png">
                 
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid " id="formulario">

            <div class="card shadow">
                <div id="crear2">
                <div class="card-header">
                    <button class="btn btn-success btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Crear usuarios</span>
                  </button>
                </div>
                    </div>
                <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="table dt-responsive nowrap" style="width:100%">
                <thead class="thead-dark">
                  <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Usuario</th>
                <th>estado</th>
                <th>Correo</th>
                <th></th>
                <th></th>
                  </tr>
                </thead>
                <tbody id="cuerpo" >
                
                </tbody>
            </table> 
                    </div>
                </div>
            </div>

            
          <div id="confirmacion3" class="modal fade" tabindex="-1" role="dialog"> 
              <div class="modal-dialog" role="document">
                <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
              <div class="modal-body">
                <form id="crear">
              <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" id="txtNombre" class="form-control" required/>
              </div>
              <div class="form-group">
                  <label>Apellido</label>
                  <input type="text" id="txtApellido" class="form-control" required/>
              </div>
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" id="txtUsuario" class="form-control" required/>
              </div>
              <div class="form-group">
                  <label>Correo</label>
                  <input type="email" id="txtCorreo" class="form-control" required/>
              </div>
            <div class="form-group">
                <label>Clave</label>
                <input type="password" id="txtClave" class="form-control" required/>
            </div>
              <div class="form-group">
                  <label>Confirmar Clave</label>
            <input type="password" id="txtConfirmarClave" class="form-control" required/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" >Guardar</button>
                </div>

              </form>
                  </div>
            </div>
            </div>
        </div>

            <div id="confirmacion" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmacion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            
            <div class="modal-body">
                <p>¿Realmente quiere eliminar este registro?</p>
                <strong id="texto"></strong>
            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btnEliminar" type="button" class="btn btn-danger">Eliminar</button>
            </div>
            </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div id="confirmacion2" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                 <h2 class="modal-title">Confirmacion</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="editar">
                <h2>¿Realmente quieres Modificar este registro?</h2>
                <strong id="texto"></strong>
                <div id="mensaje2" class="alert hidden"></div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" id="nombre" value="nombre" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" id="apellido" value="apellido" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" id="usuario" value="usuario" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email"  id="correo" value="correo" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Estado</label>

                    <select  type="text"  id="estado" value="estado" class="form-control">
                        <option>Inactivo</option>
                        <option>Activo</option>
                    </select> 
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="btnModificar" type="button" class="btn btn-primary">Modificar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Star Note 2019</span>
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
          <h5 class="modal-title" id="exampleModalLabel">Realmente quieres salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Seleccione "Salir" si está listo para finalizar su sesión actual.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="iniciosesion.php">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/menu.js" type="text/javascript"></script>
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../vendor/datatables/dataTables.fixedHeader.min.js" type="text/javascript"></script>
  <script src="../vendor/datatables/dataTables.responsive.min.js" type="text/javascript"></script>
  <script src="../vendor/datatables/responsive.bootstrap4.min.js" type="text/javascript"></script>
  <script src="../js/demo/datatables-demo.js"></script>
<script src="js/usuario/gestionusuario.js" type="text/javascript"></script>
</body>

</html>











