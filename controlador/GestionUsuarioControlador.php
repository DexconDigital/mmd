<?php
require_once '../modelo/basedatos/Conexion.php';
require_once '../modelo/vo/Usuario.php';
require_once '../modelo/dao/UsuarioDao.php';
require_once './GenericoControlador.php';
require_once './excepcion/ValidacionExcepcion.php';
require_once './util/Validacion.php';

class GestionUsuarioControlador extends GenericoControlador {

    private $usuarioDAO;

    public function __construct( &$cnn = NULL ) {
        if ( empty( $cnn ) ) {
            $cnn = Conexion::conectar();
        }
        $this->usuarioDAO = new UsuarioDAO( $cnn );
    }

    public function iniciarSesion() {
        try {
            Validacion::validar( ['razon_social' => 'obligatorio', 'nit' => 'obligatorio', 'clave' => 'obligatorio'], $_POST );
            $usuarioVO = new Usuario;
            $usuarioVO->setFecha_diligencia ( $_POST ['fecha_diligencia'] );
            $usuarioVO->setRazon_social ( $_POST['razon_social'] );
            $usuarioVO->setNit ( $_POST['nit'] ) ;

            $validacion = $this->usuarioDAO->validar( $_POST['clave'] );
            if ( empty( $validacion ) ) {
                $this->respuestaJSON( ['codigo' => 3] );
            } else {
                $consulta = $this->usuarioDAO->consultar( $_POST['razon_social'], $_POST['nit'] );

                if ( empty( $consulta ) ) {
                    $infoUsuario =  $this->usuarioDAO->insertar( $usuarioVO );
                    session_start();
                    $_SESSION['usuario'] = $infoUsuario;
                    $this->respuestaJSON( ['codigo' => 2, 'mensaje' => 'Se insertó correctamente'] );
                } else {
                    session_start();
                    $_SESSION['usuario'] = $consulta->id_usuario;
                    $this->respuestaJSON( ['codigo' => 1] );
                }
            }

        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }

    public function consultar_preguntas() {
        try {
            Validacion::validar( ['tabla' => 'obligatorio', 'contenido' => 'obligatorio'], $_POST );
            session_start();
            $tabla = $_POST ['tabla'];
            $contenido = $_POST ['contenido'];
            $id_usuario = $_SESSION ['usuario'];
            $datos = $this->usuarioDAO->consultar_respuestas( $tabla, $contenido, $id_usuario );

            if ( empty( $datos ) ) {
                $datos = $this->usuarioDAO->consultar_preguntas( $tabla, $contenido );
            }

            if ( $datos != "" ) {
                foreach ( $datos as $key => $t ) {
                    $t->usuario = $_SESSION ['usuario'];
                    if ( isset( $t->respuestas ) ) {
                        $t->respta = explode( "|", $t->respuestas );
                    }

                    //color
                    $tabla = $t->tabla;
                    switch ( $tabla ) {
                        case "clientes":
                        $t->color = "aqua";
                        break;
                        case "estrategia":
                        $t->color = "amarillo";
                        break;
                        case "tecnología":
                        $t->color = "cyan";
                        break;
                        case "operaciones":
                        $t->color = "verde";
                        break;
                        case "cultura":
                        $t->color = "lila";
                        break;
                    }
                }
            }

            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se consultó correctamente', 'datos' => $datos] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }

    public function guardar_respuesta() {
        try {
            Validacion::validar( ['id_pregunta' => 'obligatorio', 'respuestas' => 'obligatorio'], $_POST );
            session_start();
            $id_pregunta = $_POST ['id_pregunta'];
            $respuestas = $_POST ['respuestas'];
            $id_usuario = $_SESSION ['usuario'];
            $this->usuarioDAO->guardar_respuesta( $id_pregunta, $respuestas, $id_usuario );
            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se grabó correctamente'] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }

    public function modificar_respuesta() {
        try {
            Validacion::validar( ['id_respuestas' => 'obligatorio', 'respuestas' => 'obligatorio'], $_POST );
            $id_respuestas = $_POST ['id_respuestas'];
            $respuestas = $_POST ['respuestas'];
            $this->usuarioDAO->modificar_respuesta( $id_respuestas, $respuestas );
            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se grabó correctamente'] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }

    public function consultar_datos() {
        try {
            session_start();
            $id_usuario = $_SESSION ['usuario'];
            $datos = $this->usuarioDAO->consultar_datos( $id_usuario );
            $usuario = $this->usuarioDAO->consultar_usuario( $id_usuario );

            if ( $datos != "" ) {
                $constante = 20;
                $clientes = 0;
                $estrategia = 0;
                $tecnologia = 0;
                $operaciones = 0;
                $cultura = 0;

                //observaciones
                $observacion = "";

                //dimensión
                $dim_clientes = 0.2;
                $dim_estrategia = 0.35;
                $dim_tecnologia = 0.2;
                $dim_operaciones = 0.15;
                $dim_cultura = 0.1;

                //variables resultados en total
                $dim_tot_clientes = 0;
                $dim_tot_estrategia = 0;
                $dim_tot_tecnologia = 0;
                $dim_tot_operaciones = 0;
                $dim_tot_cultura = 0;

                $resultados = array ();
                $resultados_dimension = array ();

                foreach ( $datos as $key => $t ) {
                    $suma = 0;
                    $tabla = $t->tabla;
                    $result_1 = 0;
                    $calculo_1 = $t->calculos_1;
                    $calculo_2 = 0;
                    $estandar = intval( $t->estandar );
                    $observacion = $t->observaciones;
                    unset( $t->observaciones );

                    //separar las respuestas
                    $rsp = explode( "|", $t->respuestas );
                    $t->rsp = $rsp;
                    foreach ( $rsp as $rs ) {
                        if ( $rs == '' ) {
                            unset( $datos[$key] );
                        } else {
                            $suma += $rs;
                            $result_1 = round( ( ( $rs*100 )/$calculo_1 ), 2 );
                            $rsl = $result_1;
                            $calculo_2 += ( $rsl / 5 );
                            $t->rspta_suma = $suma;
                            $t->result_1 = $result_1;
                            $t->result_2 = round( ( $calculo_2 ), 2 );
                            $t->desviacion = round( ( ( ( $calculo_2 - $estandar ) / $estandar ) * 100 ), 2 );
                            $t->constante = $constante;

                        }
                    }

                    //colores
                    $contenido = strtolower( $t->contenido );
                    $t->color_contenido = "red";
                    $t->text_contenido = "light";
                    //cliente colores "compromiso con el cliente"
                    if ( $contenido == strtolower( "compromiso con el cliente" ) or
                    $contenido == strtolower( "gestión estratégica" ) or
                    $contenido == strtolower( "procesos inteligentes y adaptables" ) or
                    $contenido == strtolower( "gestión del talento & Diseño organizacional" ) ) {
                        if ( floatval( $t->result_2 ) >= floatval( 7.51 ) ) {
                            $t->color_contenido = "dark-yellow";
                            $t->text_contenido = "light";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 15.1 ) ) {
                            $t->color_contenido = "yellow";
                            $t->text_contenido = "negro";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 22.51 ) ) {
                            $t->color_contenido = "dark-green";
                            $t->text_contenido = "negro";
                        }
                    }

                    //cliente colores "experiencia del cliente"
                    if ( $contenido == strtolower( "experiencia del cliente" ) ) {
                        if ( floatval( $t->result_2 ) >= floatval( 8.76 ) ) {
                            $t->color_contenido = "dark-yellow";
                            $t->text_contenido = "light";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 17.51 ) ) {
                            $t->color_contenido = "yellow";
                            $t->text_contenido = "negro";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 26.26 ) ) {
                            $t->color_contenido = "dark-green";
                            $t->text_contenido = "negro";
                        }
                    }

                    //cliente colores "conocimiento del cliente y comportamiento"
                    if ( $contenido == strtolower( "conocimiento del cliente y comportamiento" ) or
                    $contenido == strtolower( "aplicaciones" ) or
                    $contenido == strtolower( "estándares y automatización de procesos" ) or
                    $contenido == strtolower( "cultura" ) ) {
                        if ( floatval( $t->result_2 ) >= floatval( 5.1 ) ) {
                            $t->color_contenido = "dark-yellow";
                            $t->text_contenido = "light";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 10.1 ) ) {
                            $t->color_contenido = "yellow";
                            $t->text_contenido = "negro";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 15.1 ) ) {
                            $t->color_contenido = "dark-green";
                            $t->text_contenido = "negro";
                        }
                    }

                    //cliente colores "confianza y percepción del cliente"
                    if ( $contenido == strtolower( "confianza y percepción del cliente" ) or
                    $contenido == strtolower( "gestión de la marca" ) or
                    $contenido == strtolower( "portafolio, ideación e innovación" ) or
                    $contenido == strtolower( "gestión de partes interesadas" ) or
                    $contenido == strtolower( "seguridad" ) or
                    $contenido == strtolower( "arquitectura tecnológica" ) or
                    $contenido == strtolower( "gestión ágil del cambio" ) or
                    $contenido == strtolower( "analíticas e información en tiempo real" ) ) {
                        if ( floatval( $t->result_2 ) >= floatval( 3.76 ) ) {
                            $t->color_contenido = "dark-yellow";
                            $t->text_contenido = "light";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 7.51 ) ) {
                            $t->color_contenido = "yellow";
                            $t->text_contenido = "negro";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 11.26 ) ) {
                            $t->color_contenido = "dark-green";
                            $t->text_contenido = "negro";
                        }
                    }

                    //Estrategia colores "Gestión de ecosistemas"
                    if ( $contenido == strtolower( "gestión de ecosistemas" ) or
                    $contenido == strtolower( "políticas de entregas" ) or
                    $contenido == strtolower( "liderazgo & Gobierno" ) ) {
                        if ( floatval( $t->result_2 ) >= floatval( 1.26 ) ) {
                            $t->color_contenido = "dark-yellow";
                            $t->text_contenido = "light";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 2.51 ) ) {
                            $t->color_contenido = "yellow";
                            $t->text_contenido = "negro";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 3.76 ) ) {
                            $t->color_contenido = "dark-green";
                            $t->text_contenido = "negro";
                        }
                    }

                    //Estrategia colores "Gestión de ecosistemas"
                    if ( $contenido == strtolower( "finanzas e inversiones, cartera" ) or
                    $contenido == strtolower( "clientes & mercados" ) or
                    $contenido == strtolower( "cosas conectadas" ) or
                    $contenido == strtolower( "red" ) or
                    $contenido == strtolower( "gestión automatizada de recursos" ) or
                    $contenido == strtolower( "gestión de servicios integrados" ) ) {
                        if ( floatval( $t->result_2 ) >= floatval( 2.51 ) ) {
                            $t->color_contenido = "dark-yellow";
                            $t->text_contenido = "light";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 5.1 ) ) {
                            $t->color_contenido = "yellow";
                            $t->text_contenido = "negro";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 7.51 ) ) {
                            $t->color_contenido = "dark-green";
                            $t->text_contenido = "negro";
                        }
                    }

                    //Estrategia colores "Gestión de ecosistemas"
                    if ( $contenido == strtolower( "finanzas e inversiones, cartera" ) or $contenido == strtolower( "clientes & mercados" ) ) {
                        if ( floatval( $t->result_2 ) >= floatval( 2.51 ) ) {
                            $t->color_contenido = "dark-yellow";
                            $t->text_contenido = "light";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 5.1 ) ) {
                            $t->color_contenido = "yellow";
                            $t->text_contenido = "negro";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 7.51 ) ) {
                            $t->color_contenido = "dark-green";
                            $t->text_contenido = "negro";
                        }
                    }

                    //Estrategia colores "Analiticas & datos"
                    if ( $contenido == strtolower( "analiticas & datos" ) or
                    $contenido == strtolower( "habilitación de la fuerza laboral" ) ) {
                        if ( floatval( $t->result_2 ) >= floatval( 6.26 ) ) {
                            $t->color_contenido = "dark-yellow";
                            $t->text_contenido = "light";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 12.51 ) ) {
                            $t->color_contenido = "yellow";
                            $t->text_contenido = "negro";
                        }
                        if ( floatval( $t->result_2 ) >= floatval( 18.76 ) ) {
                            $t->color_contenido = "dark-green";
                            $t->text_contenido = "negro";
                        }
                    }

                    //resultados en total
                    switch ( $tabla ) {
                        case "clientes":
                        $clientes +=  $t->result_2;
                        $dim_tot_clientes = ( $clientes * $dim_clientes );
                        $t->color = "aqua";
                        break;
                        case "estrategia":
                        $estrategia +=  $t->result_2;
                        $dim_tot_estrategia = ( $estrategia * $dim_estrategia );
                        $t->color = "amarillo";
                        break;
                        case "tecnología":
                        $tecnologia +=  $t->result_2;
                        $dim_tot_tecnologia = ( $tecnologia * $dim_tecnologia );
                        $t->color = "cyan";
                        break;
                        case "operaciones":
                        $operaciones +=  $t->result_2;
                        $dim_tot_operaciones = ( $operaciones * $dim_operaciones );
                        $t->color = "verde";
                        break;
                        case "cultura":
                        $cultura +=  $t->result_2;
                        $dim_tot_cultura = ( $cultura * $dim_cultura );
                        $t->color = "lila";
                        break;
                    }

                    //Operaciones y asignacion de arreglos
                    $dimension_total = ( ( $clientes + $estrategia + $tecnologia + $operaciones + $cultura )/ 5 );

                    $resultados_dimension =
                    array ( 'Clientes' => round( $dim_tot_clientes, 2 ), 'Estrategia' => round( $dim_tot_estrategia, 2 ), 'Tecnología' => round( $dim_tot_tecnologia, 2 ), 'Operaciones' => round( $dim_tot_operaciones, 2 ), 'Cultura' => round( $dim_tot_cultura, 2 ), 'Total' => round( $dimension_total, 2 ) );

                    $resultados =
                    array( 'clientes' => array( 'total' => round( $clientes, 2 ), 'color' => 'aqua' ), 'estrategia' => array( 'total' => round( $estrategia, 2 ), 'color' => 'amarillo' ), 'tecnología' => array( 'total' => round( $tecnologia, 2 ), 'color' => 'cyan' ), 'operaciones' => array( 'total' => round( $operaciones, 2 ), 'color' => 'verde' ), 'cultura' => array( 'total' => round( $cultura, 2 ), 'color' => 'lila' ) );

                }

                foreach ( $datos as $key => $t ) {
                    switch ( $t->tabla ) {
                        case "clientes":
                        $t->total = round( $clientes, 2 );
                        break;
                        case "estrategia":
                        $t->total = round( $estrategia, 2 );
                        break;
                        case "tecnología":
                        $t->total = round( $tecnologia, 2 );
                        break;
                        case "operaciones":
                        $t->total = round( $operaciones, 2 );
                        break;
                        case "cultura":
                        $t->total = round( $cultura, 2 );
                        break;
                    }
                }
            }

            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se consultó correctamente', 'razon' => $usuario, 'resultados' => $resultados, 'resultados_dimension' => $resultados_dimension, 'datos' => $datos, 'observacion' => $observacion] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }

    public function observaciones() {
        try {
            Validacion::validar( ['cadena_observacion' => 'obligatorio'], $_POST );
            session_start();
            $cadena_observacion = $_POST ['cadena_observacion'];
            $id_usuario = $_SESSION ['usuario'];
            $this->usuarioDAO->observaciones( $cadena_observacion, $id_usuario );
            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se grabó correctamente'] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }

    public function generarPDF() {
        try {
            Validacion::validar( ['respuesta' => 'obligatorio'], $_POST );
            $respuesta = $_POST ['respuesta'];
            $resultados = $respuesta ['resultados'];
            $datos = $respuesta ['datos'];
            $razon_social = $respuesta ['razon']['razon_social'];
            $header = '<head> 
                      <style>
                            @font-face {font-family: "Chronicle";src: url("../vendor/fonts/Chronicle Display Black.otf");}
                            @font-face {@font-face { font-family: "OpenSans-Regular";src: url("../vendor/fonts/OpenSans-Regular.ttf");}
                            h4 { font-family: Chronicle; font-size: 10pt; text-align:center; margin-top: 0; margin-bottom: 0; }
                            h6 { font-family: Chronicle; font-size: 6pt; font-weight: 100; text-align:center; margin-top: 0; margin-bottom: 0;}
                            table, td{border-collapse: collapse; color: black !important; text-align: center;font-family: OpenSans-Regular;font-size:12px; }
                            .fs-12 {font-size:12px;}
                            .mb-3 {margin-bottom: 1rem !important;}
                            .bg-red {background-color: #C00000;color: #f8f9fc !important;}
                            .bg-dark-yellow {background-color: #E55407;color: #f8f9fc !important;}
                            .bg-yellow {background-color: #FDD300;}
                            .bg-dark-green {background-color: #86F200;}
                            .bg-aqua {background-color: #3EFAC5;}
                            .bg-lila {background-color: #852766;color: white !important;}
                            .bg-amarillo {background-color: #FDD300;}
                            .bg-verde {background-color: #86F200;}
                            .bg-cyan {background-color: #34F0FF;}
                      </style> 
                   </head>';

            // Cabecera del documento
            $cabecera = "<div style='margin-bottom:7px;'> 
                            <div style='float: left; width: 10%; text-align:left;' > 
                                <img src='../img/logo.png'>
                                
                            </div> 
                            <div style='float:left; vertical-align: top; padding-left: 18px;'>
                                <h1 style='font-size: 35pt;margin-left:70px;'>Modelo de Madurez Digital - Mapa de Calor</h1> 
                            </div>
                        </div>";
            $mapa = "";

            foreach ( $resultados as $key => $data ) {
                $color_head = $data["color"];
                $color_cab = "red";
                $total = $data["total"];

                if ( $total >= 25.1 ) {
                    $color_cab = "dark-yellow";
                }
                if ( $total >= 50.1 ) {
                    $color_cab = "yellow";
                }
                if ( $total >= 75.1 ) {
                    $color_cab = "dark-green";
                }

                $key_alt = ucfirst( $key );
                $mapa .= "<td style='vertical-align:top'>
                            <table style='width:100%;'>
                                <tr style='border: 0.5px solid #858796;'>
                                    <td class='bg-{$color_head}'><h4>{$key_alt}</h4></td>
                                </tr>
                                <tr style='border: 0.5px solid #858796;'>
                                    <td class='bg-{$color_cab} fs-12'>{$total}%</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table style='width:100%;'>
                                            <tr>";

                for ( $i = 0; $i <= count( $datos )-1;
                $i++ ) {
                    $data_map = $datos[$i];
                    $constante = $data_map['constante'];
                    if ( $key == $data_map['tabla'] ) {
                        $text_color = ( $data_map['color'] == "lila" ) ? "light" : "dark";
                        $contenid = ucfirst( $data_map['contenido'] );
                        $rslt_2 = $data_map['result_2'];
                        $color_contenido = $data_map['color_contenido'];
                        $color = $data_map['color'];

                        $mapa .= "<td style='vertical-align:top'>
                                    <table style='width:100%;' class='fs-12'>
                                        <tr style='border: 0.5px solid #858796;'>
                                            <td style='height:100px;' class='bg-{$color}'>{$contenid}</td>
                                        </tr>
                                        <tr style='border: 0.5px solid #858796;'>
                                            <td class='bg-{$color_contenido}'>{$rslt_2}%</td>
                                        </tr>";

                        $pregunt = explode( "|", $data_map['preguntas'] );
                        for ( $pre = 0; $pre < count( $pregunt );
                        $pre++ ) {
                            $prg = ucfirst( $pregunt[$pre] );
                            $const_total = ( $data_map['rsp'][$pre] * $constante );
                            $color_pie = "red";

                            //Colores segun el total en el pie
                            if ( $const_total >= 25.1 ) {
                                $color_pie = "dark-yellow";
                            }
                            if ( $const_total >= 50.1 ) {
                                $color_pie = "yellow";
                            }
                            if ( $const_total >= 75.1 ) {
                                $color_pie = "dark-green";
                            }

                            $mapa .= "<tr>
                                        <td style='vertical-align:top'>
                                            <table style='width:100%;'>
                                                <tr style='border: 0.5px solid #858796;padding: 0.5rem !important;'>
                                                    <td style='height:190px;width:180px;'>{$prg}</td>
                                                </tr>
                                                <tr style='border: 0.5px solid #858796;'>
                                                    <td class='bg-{$color_pie}' >{$const_total}%</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>";
                        }

                        $mapa .= "</table>
                                </td>";
                    }
                }

                $mapa .= "</tr>
                        </table>
                        </td>
                        </tr>";

                $mapa .= "</table> 
                        </td>";
            }

            $ehtml =  "<html> 
                        {$header} 
                        <body> 
                            {$cabecera}
                            <table style='width:100%;'>
                                <tr>
                                    {$mapa}
                                </tr>
                            </table>
                            <div style='clear: both; margin: 0pt; padding: 0pt; '></div>
                        </body>                    
                  </html>";

            //var_dump( $ehtml );
            //exit();

            require_once '../vendor/mpdf/autoload.php';
            $mpdf = new \Mpdf\Mpdf( ['mode' => 'utf-8', 'format' => 'A2-L'] );
            $mpdf->WriteHTML( $ehtml );
            $pdfString = $mpdf->Output( '', 'S' );
            $pdfBase64 = base64_encode( $pdfString );
            $PDF = 'data:application/pdf;base64,' . $pdfBase64;

            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se consultó correctamente', 'PDF' => $PDF, 'nombre' => $razon_social, 'tipo' => 'MapaCalor'] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }

    public function generargraficaPDF() {
        try {
            Validacion::validar( ['respuesta' => 'obligatorio'], $_POST );
            session_start();
            $id_usuario = $_SESSION ['usuario'];
            $observaciones = $this->usuarioDAO->consultar_observacion( $id_usuario );

            $respuesta = $_POST ['respuesta'];
            $resultados = $respuesta ['resultados'];
            $resultados_dimension = $respuesta ['resultados_dimension'];
            $datos = $respuesta ['datos'];
            $razon_social = $respuesta ['razon']['razon_social'];

            //imagenes de graficas
            $dimension_img = $_POST['dimension_img'];
            $clientes_img = $_POST['clientes_img'];
            $estrategia_img = $_POST['estrategia_img'];
            $tecnología_img = $_POST['tecnología_img'];
            $operaciones_img = $_POST['operaciones_img'];
            $cultura_img = $_POST['cultura_img'];

            $header = '<head> 
                      <style>
                            @font-face {font-family: "Chronicle";src: url("../vendor/fonts/Chronicle Display Black.otf");}
                            @font-face {@font-face { font-family: "OpenSans-Regular";src: url("../vendor/fonts/OpenSans-Regular.ttf");}
                            h4 { font-family: Chronicle; font-size: 10pt; text-align:center; margin-top: 0; margin-bottom: 0; }
                            h6 { font-family: Chronicle; font-size: 6pt; font-weight: 100; text-align:center; margin-top: 0; margin-bottom: 0;}
                            table, td {border-collapse: collapse; color: black !important;font-family: OpenSans-Regular;font-size:12px; }
                            .fs-12 {font-size:12px;}
                            .mb-3 {margin-bottom: 1rem !important;}
                            .bg-red {background-color: #C00000;color: #f8f9fc !important;}
                            .bg-dark-yellow {background-color: #E55407;color: #f8f9fc !important;}
                            .bg-yellow {background-color: #FDD300;}
                            .bg-dark-green {background-color: #86F200;}
                            .bg-aqua {background-color: #3EFAC5;}
                            .bg-lila {background-color: #852766;color: white !important;}
                            .bg-amarillo {background-color: #FDD300;}
                            .bg-verde {background-color: #86F200;}
                            .bg-cyan {background-color: #34F0FF;}
                            .bg-ladrillo {background-color: #F07B3B;color: white !important;}
                      </style> 
                   </head>';

            //cabecera graficas
            $cabecera = "<div style='margin-bottom:7px;'> 
                            <div style='float: left; width: 12%; text-align:left;' > 
                                <img src='../img/logo.png'>
                            </div> 
                            <div style='float:left; vertical-align: top; padding-left: 18px;'>
                                <h1 style='font-size: 22pt;margin-left:70px;'>Modelo de Madurez Digital</h1> 
                            </div>
                        </div>";

            $result_dimension = "<div style='float: left;width: 40%;' > 
                                    <table style='width:100%;'>
                                        <thead>
                                            <tr>
                                                <th class='bg-ladrillo' style='border: 0.5px solid #858796;'>Dimensión</th>
                                                <th class='bg-ladrillo' style='text-align: center;border: 0.5px solid #858796;'>Resultado</th>
                                                <th class='bg-ladrillo' style='text-align: center;border: 0.5px solid #858796;'>Estandar</th>
                                                <th class='bg-ladrillo' style='text-align: center;border: 0.5px solid #858796;'>% Desviación</th>
                                            </tr>
                                        </thead>
                                        <tbody>";

            foreach ( $resultados_dimension as $key => $value ) {
                $estandar = "0";
                switch ( $key ) {
                    case "Clientes":
                    $estandar = "20";
                    break;
                    case "Estrategia":
                    $estandar = "30";
                    break;
                    case "Tecnología":
                    $estandar = "15";
                    break;
                    case "Operaciones":
                    $estandar = "25";
                    break;
                    case "Cultura":
                    $estandar = "10";
                    break;
                    case "Total":
                    $estandar = "100";
                    break;
                }

                $resul_dim = round( ( ( ( $value - $estandar ) / $estandar ) * 100 ), 2 );
                $text_bold = ( $key == 'Total' ) ? 'font-weight: bold;' : '';

                $result_dimension .= "<tr>
                                        <td style='border: 0.5px solid #858796;{$text_bold}'>{$key}</td>
                                        <td style='text-align: center;border: 0.5px solid #858796;{$text_bold}'>{$value}%</td>
                                        <td style='text-align: center;border: 0.5px solid #858796;{$text_bold}'>{$estandar}%</td>
                                        <td style='text-align: center;border: 0.5px solid #858796;{$text_bold}'>{$resul_dim}%</td>
                                    <tr>";
            }

            $result_dimension .= "</tbody>
                                    </table>
                                
                                <div style='width:100%;margin-top:10%;background-color:#F2F2F2;padding:3%'>";

            if ( $observaciones != "" ) {
                $observacion = explode( "|", $observaciones->observaciones );
                $result_dimension .= $observacion[0];
            }

            $result_dimension .= "</div>
                            </div>";

            $result_dimension .= "<div style='float: right;' > 
                                    <table style='width:100%;'>
                                        <tr>
                                            <td style='text-align: center;'>
                                                <img src='' style='width:1500px;'>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table class='tabla' style='width:40%;margin-top:5%;margin-left:10%'>
                                                    <thead>
                                                        <tr>
                                                            <th class='bg-ladrillo' style='text-align: center;border: 0.5px solid #858796;'>Escala</th>
                                                            <th class='bg-ladrillo' style='text-align: center;border: 0.5px solid #858796;'>Rango %</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style='border: 0.5px solid #858796;'>En Desarrollo</td>
                                                            <td class='bg-red' style='text-align: center;border: 0.5px solid #858796;'>0 a 25</td>
                                                        </tr>
                                                        <tr>
                                                            <td style='border: 0.5px solid #858796;'>Básico</td>
                                                            <td class='bg-dark-yellow' style='text-align: center;'>26 a 50</td>
                                                        </tr>
                                                        <tr>
                                                            <td style='border: 0.5px solid #858796;'>Avanzado</td>
                                                            <td class='bg-yellow' style='text-align: center;border: 0.5px solid #858796;'>51 a 75</td>
                                                        </tr>
                                                        <tr>
                                                            <td style='border: 0.5px solid #858796;'>Líder</td>
                                                            <td class='bg-dark-green' style='text-align: center;border: 0.5px solid #858796;'>76 a 100</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>";

            //<pagebreak/>

            $result_dimensiones = "";
            foreach ( $resultados as $key => $value ) {
                $color = $value['color'];
                $total = $value['total'];
                $color_pie = "red";
                $estandar = "";
                $breakline = "";
                $mi_grafica = "";
                //Colores segun el total en el pie
                if ( $total >= 25.1 ) {
                    $color_pie = "dark-yellow";
                }
                if ( $total >= 50.1 ) {
                    $color_pie = "yellow";
                }
                if ( $total >= 75.1 ) {
                    $color_pie = "dark-green";
                }

                //asignación de observaciones
                if ( $observaciones != "" ) {

                    $obser = "";
                    $observacion = explode( "|", $observaciones->observaciones );

                    switch ( $key ) {
                        case "clientes":
                        $obser = $observacion[1];
                        break;
                        case "estrategia":
                        $obser = $observacion[2];
                        break;
                        case "tecnología":
                        $obser = $observacion[3];
                        break;
                        case "operaciones":
                        $obser = $observacion[4];
                        break;
                        case "cultura":
                        $obser = $observacion[5];
                        break;
                    }
                }

                //asignación de datos
                $abreviado = "";
                switch ( $key ) {
                    case "clientes":
                    $breakline = "<pagebreak/>";
                    $mi_grafica = $clientes_img;
                    $abreviado = "CL";
                    break;
                    case "estrategia":
                    $breakline = "<pagebreak/>";
                    $mi_grafica = $estrategia_img;
                    $abreviado = "ET";
                    break;
                    case "tecnología":
                    $breakline = "<pagebreak/>";
                    $mi_grafica = $tecnología_img;
                    $abreviado = "TC";
                    break;
                    case "operaciones":
                    $breakline = "<pagebreak/>";
                    $mi_grafica = $operaciones_img;
                    $abreviado = "OP";
                    break;
                    case "cultura":
                    $breakline = "";
                    $mi_grafica = $cultura_img;
                    $abreviado = "OC";
                    break;
                }

                $titulo_mayus = ucfirst( $key );

                $result_dimensiones .= $cabecera;
                $result_dimensiones .= "<div style='float: left;width: 40%;'>
                                        <div style='width:80%;background-color:#F2F2F2;padding:3%'>
                                            {$obser}
                                        </div>
                                    </div>
                                    <div style='float: right;'>
                                        <table style='width:100%;'>
                                            <tr>
                                                <td>
                                                    <table style='width:100%;'>
                                                        <thead>
                                                            <tr>
                                                                <th class='bg-{$color}' colspan='4' style='border: 0.5px solid #858796;text-align: center;'>Dimensión: {$titulo_mayus}</th>
                                                            </tr>
                                                            <tr>
                                                                <th class='bg-{$color}' style='border: 0.5px solid #858796;'>Sub-Dimensión</th>
                                                                <th class='bg-{$color}' style='text-align: center;border: 0.5px solid #858796;'>Resultado</th>
                                                                <th class='bg-{$color}' style='text-align: center;border: 0.5px solid #858796;'>Estandar</th>
                                                                <th class='bg-{$color}' style='text-align: center;border: 0.5px solid #858796;'>% Desviación</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>";
                $total = 0;
                $tot_desv = 0;
                for ( $i = 0; $i <= count( $datos )-1; $i++ ) {
                    $data = $datos[$i];
                    if ($key == $data['tabla']) {
                        $result_2 = $data['result_2'];
                        $estandar = $data['estandar'];
                        $desviacion = $data['desviacion'];
                        $contenido_mayus =  ucfirst( $data['contenido'] );
                        
                        $total = $data['total'];
                        $tot_desv = ((($total - 100) / 100) * 100);
                        $result_dimensiones .= "<tr>
                                                    <td style='border: 0.5px solid #858796;'>{$contenido_mayus}</td>
                                                    <td style='text-align: center;border: 0.5px solid #858796;'>{$result_2}%</td>
                                                    <td style='text-align: center;border: 0.5px solid #858796;'>{$estandar}%</td>
                                                    <td style='text-align: center;border: 0.5px solid #858796;'>{$desviacion}%</td>
                                                <tr>";
                    }
                }

                $result_dimensiones .= "<tr>
                                                <td style='border: 0.5px solid #858796;font-weight: bold;'>Total</td>
                                                <td style='text-align: center;border: 0.5px solid #858796;font-weight: bold;'>{$total}%</td>
                                                <td style='text-align: center;border: 0.5px solid #858796;font-weight: bold;'>100%</td>
                                                <td style='text-align: center;border: 0.5px solid #858796;font-weight: bold;'>{$tot_desv}%</td>
                                            <tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style='text-align: center;'>
                                    <img src='' style='width:100%;margin-top:5%;'>
                                </td>
                            </tr>

                        </table>
                    </div>
                {$breakline}";
            }

            $ehtml =  "<html> 
                            {$header}
                            <body> 
                                {$cabecera}
                                {$result_dimension}
                                <pagebreak/>
                                {$result_dimensiones}
                                <div style='clear: both; margin: 0pt; padding: 0pt; '></div>
                            </body>                    
                      </html>";

            //var_dump( $result_dimension );
            //exit();
            require_once '../vendor/mpdf/autoload.php';
            $mpdf = new \Mpdf\Mpdf( ['mode' => 'utf-8', 'format' => 'A4-L'] );
            $mpdf->WriteHTML( $ehtml );
            $pdfString = $mpdf->Output( '', 'S' );
            $pdfBase64 = base64_encode( $pdfString );
            $PDF = 'data:application/pdf;base64,' . $pdfBase64;

            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se consultó correctamente', 'PDF' => $PDF, 'nombre' => $razon_social, 'tipo' => 'reporte'] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }
}

$controlador = new GestionUsuarioControlador();
$opcion = $_GET['opcion'];
$controlador->$opcion();
