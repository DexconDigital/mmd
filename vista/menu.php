<?php
session_start();
if ( !isset( $_SESSION ['usuario'] ) ) {
    header( 'Location:iniciosesion.php' );
}
?>
<!DOCTYPE html>
<html lang="en">

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
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h4 class="text-dark"><span class="font-weight-bold"> Dexcon. </span> Digital</h4>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="../img/perfil.png">
                            </a>
                            <!-- Dropdown - Salir -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Cuerpo Inicio -->
                <div class="container-fluid shadow bg-white" id="formulario">
                    <div class="pt-5 row d-flex justify-content-center">
                        <div class="col-md-2 col-sm-3 col-6">
                            <img src="../img/logo.png" class="w-50 my-auto">
                        </div>
                        <div class="col-md-5 col-sm-5 col-6">
                            <p class="text-dark font-weight-bold h5">MODELO DE EVALUACIÓN DE MADUREZ DIGITAL</p>
                        </div>
                    </div>
                    <div class="row pt-5 d-flex justify-content-center">
                        <div class="col-xl-2 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card border-aqua mb-3 w-100">
                                <div class="card-header bg-transparent">CLIENTES</div>
                                <div class="card-body text-primary">
                                    <button class="btn btn-aqua btn-block text-dark modelo" data-tabla="clientes">Compromiso con el cliente</button>
                                    <button class="btn btn-aqua btn-block text-dark modelo" data-tabla="clientes">Experiencia del cliente</button>
                                    <button class="btn btn-aqua btn-block text-dark modelo" data-tabla="clientes">Conocimiento del cliente y comportamiento</button>
                                    <button class="btn btn-aqua btn-block text-dark modelo" data-tabla="clientes">Confianza y percepción del cliente</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card border-warning mb-3 w-100">
                                <div class="card-header bg-transparent">ESTRATEGIA</div>
                                <div class="card-body text-primary">
                                    <a class="btn btn-warning btn-block text-dark">Gestión de la marca</a>
                                    <a class="btn btn-warning btn-block text-dark">Gestión de ecosistemas</a>
                                    <a class="btn btn-warning btn-block text-dark">Finanzas e inversiones, cartera</a>
                                    <a class="btn btn-warning btn-block text-dark">Clientes & mercados</a>
                                    <a class="btn btn-warning btn-block text-dark">Portafolio, ideación e innovación</a>
                                    <a class="btn btn-warning btn-block text-dark">Gestión de partes interesadas</a>
                                    <a class="btn btn-warning btn-block text-dark">Gestión estrategica</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card border-cyan mb-3 w-100">
                                <div class="card-header bg-transparent">TECNOLOGÍA</div>
                                <div class="card-body text-primary">
                                    <a class="btn btn-cyan btn-block text-dark">Aplicaciones</a>
                                    <a class="btn btn-cyan btn-block text-dark">Cosas conectadas</a>
                                    <a class="btn btn-cyan btn-block text-dark">Analiticas & datos</a>
                                    <a class="btn btn-cyan btn-block text-dark">Politicas de entregas</a>
                                    <a class="btn btn-cyan btn-block text-dark">Red</a>
                                    <a class="btn btn-cyan btn-block text-dark">Seguridad</a>
                                    <a class="btn btn-cyan btn-block text-dark">Arquitectura tecnológica</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card border-verde mb-3 w-100">
                                <div class="card-header bg-transparent">OPERACIONES</div>
                                <div class="card-body text-primary">
                                    <a class="btn btn-verde btn-block text-dark">Gestión ágil del cambio</a>
                                    <a class="btn btn-verde btn-block text-dark">Gestión automatizada de recursos</a>
                                    <a class="btn btn-verde btn-block text-dark">Gestión de servicios integrados</a>
                                    <a class="btn btn-verde btn-block text-dark">Analíticas e información en tiempo real</a>
                                    <a class="btn btn-verde btn-block text-dark">Procesos inteligentes y adaptables</a>
                                    <a class="btn btn-verde btn-block text-dark">Estándares y automatización de procesos</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card border-lila mb-3 w-100">
                                <div class="card-header bg-transparent">ORGANIZACIÓN & CULTURA</div>
                                <div class="card-body text-primary">
                                    <a class="btn btn-lila btn-block text-light">Cultura</a>
                                    <a class="btn btn-lila btn-block text-light">Liderazgo & Gobierno</a>
                                    <a class="btn btn-lila btn-block text-light">Gestión del talento & Diseño organizacional</a>
                                    <a class="btn btn-lila btn-block text-light">Habilitación de la fuerza laboral</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cuerpo Inicio -->
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;
                            Dexcon <?php echo date( 'Y' ); ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Modal preguntas -->
    <div class="modal fade bd-example-modal-lg" id="prgModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h6 class="modal-title text-uppercase text-light" id="exampleModalLabel1"></h6>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body text-light container">
                    <form id="frm">
                        <div id="contenido_preguntas"></div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <button class="btn btn-cyan" href="#!">Guardar Puntaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal preguntas -->
    
    <!-- Modal salir -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Realmente quieres salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Salir" si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary text-light" href="iniciosesion.php">Salir</a>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="../vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/menu.js" type="text/javascript"></script>
<script src="../js/sb-admin-2.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/jquery.ui.touch-punch.min.js"></script>
<script src="js/usuario/gestionusuario.js?v=<?php echo uniqid(); ?>" type="text/javascript"></script>

</html>
