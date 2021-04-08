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
            Validacion::validar( ['razon_social' => 'obligatorio', 'nit' => 'obligatorio'], $_POST );
            $usuarioVO = new Usuario;
            $usuarioVO->setFecha_diligencia ( $_POST ['fecha_diligencia'] );
            $usuarioVO->setRazon_social ( $_POST['razon_social'] );
            $usuarioVO->setNit ( $_POST['nit'] ) ;
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
                    $estandar = intval($t->estandar);

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
                            $t->desviacion = round(((($calculo_2 - $estandar) / $estandar) * 100), 2);
                            $t->constante = $constante;
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

            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se consultó correctamente', 'razon' => $usuario, 'resultados' => $resultados, 'resultados_dimension' => $resultados_dimension, 'razon' => $usuario, 'datos' => $datos] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }
}

$controlador = new GestionUsuarioControlador();
$opcion = $_GET['opcion'];
$controlador->$opcion();
