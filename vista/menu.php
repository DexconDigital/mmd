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
    <link rel="icon" type="image/png" href="../img/favicon.png">
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
                    <label class="h4 text-negro">Dexcon Digital</label>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600" id="razon_menu"></span>
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
                    <div class="pt-5 row">
                        <div class="col-md-3 logo-principal">
                            <img src="../img/logo.png" class="w-12 mt-3 ml-35">
                        </div>
                        <div class="col-md-8 titulo-principal-container d-flex justify-content-center">
                            <h1 class="titulo-principal text-negro font-weight-bold mt-2">Modelo de Madurez Digital</h1>
                        </div>
                    </div>
                    <div class="row pt-5 d-flex justify-content-center">
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card card-hover border-aqua mb-3 w-100">
                                <div class="card-header bg-transparent font-weight-bold text-negro">CLIENTES</div>
                                <div class="card-body text-primary">
                                    <button class="btn btn-aqua btn-block modelo" data-tabla="clientes">Compromiso con el cliente</button>
                                    <button class="btn btn-aqua btn-block modelo" data-tabla="clientes">Experiencia del cliente</button>
                                    <button class="btn btn-aqua btn-block modelo" data-tabla="clientes">Conocimiento del cliente y comportamiento</button>
                                    <button class="btn btn-aqua btn-block modelo" data-tabla="clientes">Confianza y percepción del cliente</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card card-hover border-amarillo mb-3 w-100">
                                <div class="card-header bg-transparent font-weight-bold text-negro">ESTRATEGIA</div>
                                <div class="card-body text-primary">
                                    <button class="btn btn-amarillo btn-block modelo" data-tabla="estrategia">Gestión de la marca</button>
                                    <button class="btn btn-amarillo btn-block modelo" data-tabla="estrategia">Gestión de ecosistemas</button>
                                    <button class="btn btn-amarillo btn-block modelo" data-tabla="estrategia">Finanzas e inversiones, cartera</button>
                                    <button class="btn btn-amarillo btn-block modelo" data-tabla="estrategia">Clientes & mercados</button>
                                    <button class="btn btn-amarillo btn-block modelo" data-tabla="estrategia">Portafolio, ideación e innovación</button>
                                    <button class="btn btn-amarillo btn-block modelo" data-tabla="estrategia">Gestión de partes interesadas</button>
                                    <button class="btn btn-amarillo btn-block modelo" data-tabla="estrategia">Gestión estratégica</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card card-hover border-cyan mb-3 w-100">
                                <div class="card-header bg-transparent font-weight-bold text-negro">TECNOLOGÍA</div>
                                <div class="card-body text-primary">
                                    <button class="btn btn-cyan btn-block modelo" data-tabla="tecnología">Aplicaciones</button>
                                    <button class="btn btn-cyan btn-block modelo" data-tabla="tecnología">Cosas conectadas</button>
                                    <button class="btn btn-cyan btn-block modelo" data-tabla="tecnología">Analiticas & datos</button>
                                    <button class="btn btn-cyan btn-block modelo" data-tabla="tecnología">Políticas de entregas</button>
                                    <button class="btn btn-cyan btn-block modelo" data-tabla="tecnología">Red</button>
                                    <button class="btn btn-cyan btn-block modelo" data-tabla="tecnología">Seguridad</button>
                                    <button class="btn btn-cyan btn-block modelo" data-tabla="tecnología">Arquitectura tecnológica</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card card-hover border-verde mb-3 w-100">
                                <div class="card-header bg-transparent font-weight-bold text-negro">OPERACIONES</div>
                                <div class="card-body text-primary">
                                    <button class="btn btn-verde btn-block modelo" data-tabla="operaciones">Gestión ágil del cambio</button>
                                    <button class="btn btn-verde btn-block modelo" data-tabla="operaciones">Gestión automatizada de recursos</button>
                                    <button class="btn btn-verde btn-block modelo" data-tabla="operaciones">Gestión de servicios integrados</button>
                                    <button class="btn btn-verde btn-block modelo" data-tabla="operaciones">Analíticas e información en tiempo real</button>
                                    <button class="btn btn-verde btn-block modelo" data-tabla="operaciones">Procesos inteligentes y adaptables</button>
                                    <button class="btn btn-verde btn-block modelo" data-tabla="operaciones">Estándares y automatización de procesos</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 d-flex justify-content-center">
                            <div class="card card-hover border-lila mb-3 w-100">
                                <div class="card-header bg-transparent font-weight-bold text-negro">ORGANIZACIÓN & CULTURA</div>
                                <div class="card-body text-primary">
                                    <button class="btn btn-lila btn-block text-light modelo" data-tabla="cultura">Cultura</button>
                                    <button class="btn btn-lila btn-block text-light modelo" data-tabla="cultura">Liderazgo & Gobierno</button>
                                    <button class="btn btn-lila btn-block text-light modelo" data-tabla="cultura">Gestión del talento & Diseño organizacional</button>
                                    <button class="btn btn-lila btn-block text-light modelo" data-tabla="cultura">Habilitación de la fuerza laboral</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-3 d-flex justify-content-center">
                        <button class="btn btn-negro" id="results">Resultados</button>
                    </div>
                </div>

                <!-- Cuerpo Inicio -->
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright text-muted">
                        <div>Diseñado y Desarrollado por Dexcon Consultores SAS | <a href="https://www.dexcondigital.com/" target="_blank">Dexcon Digital</a><span class="dexcon_copy"> ©Copyright <?php echo date('Y') ?>. Todos los derechos reservados.</span></div>
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
            <div class="modal-content bg-negro">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-light first-uppercase pl-2"><span id="exampleModalLabel1"></span></h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body text-light container">
                    <form id="frm">
                        <div id="contenido_preguntas"></div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <div id="accion_btn"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal preguntas -->

    <!-- Modal resultados -->
    <div class="modal fade modal-fullscreen" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModallabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-negro">
                <div class="modal-header border-0">
                    <div class="ml-2">
                        <img src="../img/logo_blanco.png" class="logo-titulo mt-1">
                        <h4 class="modal-title text-light modal-titulo" id="resultModallabel">Resultados Modelo de Madurez Digital</h4>
                    </div>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body text-light container-fluid">
                    <form id="frm1">
                        <ul class="nav nav-pills bg-negro" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-light" id="dimensiones-tab" data-toggle="tab" href="#dimensiones" role="tab" aria-controls="dimensiones" aria-selected="true">Por Dimensiones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light clientes" id="Clientes-tab" data-info="clientes" data-toggle="tab" href="#Clientes" role="tab" aria-controls="Clientes" aria-selected="false">Clientes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light estrategia" id="Estrategia-tab" data-info="estrategia" data-toggle="tab" href="#Estrategia" role="tab" aria-controls="Estrategia" aria-selected="false">Estrategia</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light tecnologia" id="Tecnologia-tab" data-info="tecnología" data-toggle="tab" href="#Tecnologia" role="tab" aria-controls="Tecnologia" aria-selected="false">Tecnología</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light operaciones" id="Operaciones-tab" data-info="operaciones" data-toggle="tab" href="#Operaciones" role="tab" aria-controls="Operaciones" aria-selected="false">Operaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light cultura" id="Estrategia-tab" data-info="cultura" data-toggle="tab" href="#Cultura" role="tab" aria-controls="Cultura" aria-selected="false">Organización & Cultura</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" id="Mapa_calor-tab" data-info="mapa_calor" data-toggle="tab" href="#Mapa_calor" role="tab" aria-controls="Mapa_calor" aria-selected="false">Mapa de Calor</a>
                            </li>
                            <li class="nav-item">
                                <a id="pdf" class="nav-link text-light" href="#">Generar Mapa</a>
                            </li>
                            <li class="nav-item">
                                <a id="pdfgraficas" class="nav-link text-light" href="#">Descargar Reporte</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="dimensiones" role="tabpanel" aria-labelledby="dimensiones-tab">
                                <div class="bg-white pt-2 rounded container-fluid">
                                    <div class="row">
                                        <div class="col-lg-7 ">
                                            <div class="table-responsive">
                                                <div class="graficas">
                                                    <canvas id="dimension_grafica" class="grafica pb-5"></canvas>
                                                    <canvas id="dimension_grafica_h"></canvas>
                                                    <canvas id="clientes_grafica_h"></canvas>
                                                    <canvas id="estrategia_grafica_h"></canvas>
                                                    <canvas id="tecnología_grafica_h"></canvas>
                                                    <canvas id="operaciones_grafica_h"></canvas>
                                                    <canvas id="cultura_grafica_h"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="table-responsive">
                                                <h5 class="text-negro mt-2 font-weight-bold text-nowrap">Resultados por Dimensión(%)</h5>
                                                <table class="table table-sm table-bordered fs-14">
                                                    <thead class="bg-ladrillo text-light text-nowrap">
                                                        <th>Dimensión</th>
                                                        <th class="text-center">Resultado</th>
                                                        <th class="text-center">Estandar</th>
                                                        <th class="text-center">% Desviación</th>
                                                    </thead>
                                                    <tbody id="dimension" class="text-negro"></tbody>
                                                </table>
                                                <div id="dim" class="w-100 shadow-none fs-14 editor text-dark"></div>
                                                <a href="#!" class="observacion_post btn btn-negro text-light mt-2 mb-4 shadow-none">Grabar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Clientes" role="tabpanel" aria-labelledby="Clientes-tab">
                                <div class="bg-white pt-2 rounded container-fluid">
                                    <div class="row">
                                        <div class="col-lg-7 table-responsive">
                                            <div class="table-responsive">
                                                <div class="graficas">
                                                    <canvas id="clientes_grafica" class="grafica pb-5 bg-light"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="table-responsive">
                                                <h5 class="text-negro mt-2 font-weight-bold  text-nowrap">Resultados subdimensión Clientes(%)</h5>
                                                <table class="table table-sm table-bordered fs-14">
                                                    <thead class="bg-aqua text-negro text-nowrap">
                                                        <th class="text-nowrap">Sub-Dimensión</th>
                                                        <th class="text-center">Resultado</th>
                                                        <th class="text-center">Estandar</th>
                                                        <th class="text-center">% Desviación</th>
                                                    </thead>
                                                    <tbody class="tabla_clientes text-negro"></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th class="text-left text-negro" scope="row">Total</th>
                                                            <th class="total_tabla_clientes text-center text-negro" scope="row"></th>
                                                            <th class="total_estandar_clientes text-center text-negro" scope="row"></th>
                                                            <th class="total_desviación_clientes text-center text-negro" scope="row"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div id="cli" class="w-100 shadow-none mb-4 fs-14 editor"></div>
                                                <a href="#!" class="observacion_post btn btn-negro text-light mt-2 mb-4 shadow-none">Grabar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Estrategia" role="tabpanel" aria-labelledby="Estrategia-tab">
                                <div class="bg-white pt-2 rounded container-fluid">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="table-responsive">
                                                <div class="graficas">
                                                    <canvas id="estrategia_grafica" class="grafica pb-5 bg-light"></canvas>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="table-responsive">
                                                <h5 class="text-negro mt-2 font-weight-bold text-nowrap">Resultados subdimensión Estrategia(%)</h5>
                                                <table class="table table-sm table-bordered fs-14">
                                                    <thead class="bg-amarillo text-negro text-nowrap">
                                                        <th class="text-nowrap">Sub-Dimensión</th>
                                                        <th class="text-center">Resultado</th>
                                                        <th class="text-center">Estandar</th>
                                                        <th class="text-center">% Desviación</th>
                                                    </thead>
                                                    <tbody class="tabla_estrategia text-negro"></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th class="text-left text-negro" scope="row">Total</th>
                                                            <th class="total_tabla_estrategia text-center text-negro" scope="row"></th>
                                                            <th class="total_estandar_estrategia text-center text-negro" scope="row"></th>
                                                            <th class="total_desviación_estrategia text-center text-negro" scope="row"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div id="estra" class="w-100 shadow-none mb-4 fs-14 editor"></div>
                                                <a href="#!" class="observacion_post btn btn-negro text-light mt-2 mb-4 shadow-none">Grabar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Tecnologia" role="tabpanel" aria-labelledby="Tecnologia-tab">
                                <div class="bg-white pt-2 rounded container-fluid">
                                    <div class="row">
                                        <div class="col-lg-7 table-responsive">
                                            <div class="table-responsive">
                                                <div class="graficas">
                                                    <canvas id="tecnología_grafica" class="grafica pb-5 bg-light"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="table-responsive">
                                                <h5 class="text-negro mt-2 font-weight-bold text-nowrap">Resultados subdimensión Tecnología(%)</h5>
                                                <table class="table table-sm table-bordered fs-14">
                                                    <thead class="bg-cyan text-negro text-nowrap">
                                                        <th class="text-nowrap">Sub-Dimensión</th>
                                                        <th class="text-center">Resultado</th>
                                                        <th class="text-center">Estandar</th>
                                                        <th class="text-center">% Desviación</th>
                                                    </thead>
                                                    <tbody class="tabla_tecnología text-negro"></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th class="text-left text-negro" scope="row">Total</th>
                                                            <th class="total_tabla_tecnología text-center text-negro" scope="row"></th>
                                                            <th class="total_estandar_tecnología text-center text-negro" scope="row"></th>
                                                            <th class="total_desviación_tecnología text-center text-negro" scope="row"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div id="tecno" class="w-100 shadow-none mb-4 fs-14 editor"></div>
                                                <a href="#!" class="observacion_post btn btn-negro text-light mt-2 mb-4 shadow-none">Grabar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Operaciones" role="tabpanel" aria-labelledby="Operaciones-tab">
                                <div class="bg-white pt-2 rounded container-fluid">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="table-responsive">
                                                <div class="graficas">
                                                    <canvas id="operaciones_grafica" class="grafica pb-5 bg-light"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="table-responsive">
                                                <h5 class="text-negro mt-2 font-weight-bold text-nowrap">Resultados subdimensión Operaciones(%)</h5>
                                                <table class="table table-sm table-bordered fs-14">
                                                    <thead class="bg-verde text-negro text-nowrap">
                                                        <th class="text-nowrap">Sub-Dimensión</th>
                                                        <th class="text-center">Resultado</th>
                                                        <th class="text-center">Estandar</th>
                                                        <th class="text-center">% Desviación</th>
                                                    </thead>
                                                    <tbody class="tabla_operaciones text-negro"></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th class="text-left text-negro" scope="row">Total</th>
                                                            <th class="total_tabla_operaciones text-center text-negro" scope="row"></th>
                                                            <th class="total_estandar_operaciones text-center text-negro" scope="row"></th>
                                                            <th class="total_desviación_operaciones text-center text-negro" scope="row"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div id="opera" class="w-100 shadow-none mb-4 fs-14 editor"></div>
                                                <a href="#!" class="observacion_post btn btn-negro text-light mt-2 mb-4 shadow-none">Grabar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Cultura" role="tabpanel" aria-labelledby="Cultura-tab">
                                <div class="bg-white pt-2 rounded container-fluid">
                                    <div class="row">
                                        <div class="col-lg-7 table-responsive">
                                            <div class="table-responsive">
                                                <div class="graficas">
                                                    <canvas id="cultura_grafica" class="grafica pb-5 bg-light"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="table-responsive">
                                                <h5 class="text-negro mt-2 font-weight-bold text-nowrap">Resultados subdimensión Cultura(%)</h5>
                                                <table class="table table-sm table-bordered fs-14">
                                                    <thead class="bg-lila text-light text-nowrap">
                                                        <th class="text-nowrap">Sub-Dimensión</th>
                                                        <th class="text-center">Resultado</th>
                                                        <th class="text-center">Estandar</th>
                                                        <th class="text-center">% Desviación</th>
                                                    </thead>
                                                    <tbody class="tabla_cultura text-negro"></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th class="text-left text-negro" scope="row">Total</th>
                                                            <th class="total_tabla_cultura text-center text-negro" scope="row"></th>
                                                            <th class="total_estandar_cultura text-center text-negro" scope="row"></th>
                                                            <th class="total_desviación_cultura text-center text-negro" scope="row"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div id="cul" class="w-100 shadow-none mb-4 fs-14 editor"></div>
                                                <a href="#!" class="observacion_post btn btn-negro text-light mt-2 mb-4 shadow-none">Grabar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Mapa_calor" role="tabpanel" aria-labelledby="Mapa_calor-tab">
                                <div class="bg-white pt-2 rounded pb-2">
                                    <div class="table-responsive container-fluid" style="max-height:48rem;">
                                        <div class="row flex-nowrap" id="tabla_mapa"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal resultados -->

    <!-- Modal salir -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">¿Realmente quiere salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Salir" si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-negro" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-red" href="iniciosesion.php">Salir</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/menu.js" type="text/javascript"></script>
<script src="../vendor/chart.js/Chart.js"></script>
<script src="../css/dist/sweetalert.js"></script>
<script src="../js/sb-admin-2.js"></script>
<script src="js/usuario/gestionusuario.js?v=<?php echo uniqid(); ?>" type="text/javascript"></script>

</html>
