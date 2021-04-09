<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="dexcon" content="">
    <title>Ingreso</title>
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="../css/dist/sweetalert.css">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
</head>

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-4 d-lg-block bg-negro text-center">
                                <img src="../img/logo_blanco.png" class="w-50 m-5" />
                            </div>
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Modelo de evaluación de madurez digital</h1>
                                    </div>
                                    <form id="frm">
                                        <div class="form-group">
                                            <label for="usuario">Fecha diligenciamiento</label>
                                            <input type="date" id="fecha_diligencia" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="clave">Razon social</label>
                                            <input type="text" id="razon_social" class="form-control" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="clave">NIT</label>
                                            <input type="text" id="nit" class="form-control" />
                                        </div>
                                        <div id="mensaje" class="form-group" style="color:red;"></div>

                                        <button class="btn btn-verde text-dark btn-block">Ingresar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer copyright text-center">
                        <span>Diseñado y Desarrollado por Dexcon Consultores SAS | Dexcon Digital | ©Copyright <?php echo date('Y') ?>. Todos los derechos reservados.</span>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery-3.3.1.min.js" type="text/javascript"></script>
    <script src="../vista/js/menu.js" type="text/javascript"></script>
    <script src="../vista/js/iniciosesion/iniciosesion.js?v=><?php echo uniqid(); ?>" type="text/javascript"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../css/dist/sweetalert.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
