<?php
require_once '../modelo/basedatos/Conexion.php';
require_once '../modelo/vo/Usuario.php';
require_once '../modelo/dao/UsuarioDAO.php';
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
                $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se insertó correctamente'] );
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
            $tabla = $_POST ['tabla'];
            $contenido = $_POST ['contenido'];
            $datos = $this->usuarioDAO->consultar_preguntas( $tabla, $contenido );
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
            $this->respuestaJSON( ['codigo' => 1, 'mensaje' => 'Se insertó correctamente'] );
        } catch ( ValidacionExcepcion $error ) {
            $this->respuestaJSON( ['codigo' => $error->getCode(), 'mensaje' => $error->getMessage()] );
        }
    }
}

$controlador = new GestionUsuarioControlador();
$opcion = $_GET['opcion'];
$controlador->$opcion();
