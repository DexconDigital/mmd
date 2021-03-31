<?php

class UsuarioDAO {

    /**
    * @var PDO
    */

    private $cnn;

    public function __construct( &$cnn ) {
        $this->cnn = $cnn;
    }

    public function consultar( $razon_social, $nit ) {
        $sql = "SELECT * FROM  usuario WHERE razon_social=:razon_social AND nit=:nit";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( ['razon_social'=>$razon_social, 'nit'=>$nit] );
        return $sentencia->fetch( PDO::FETCH_OBJ );
    }

    public function insertar( Usuario $usuario ) {
        $sql = "INSERT INTO usuario (fecha_diligencia, razon_social, nit) 
                VALUES (:fecha_diligencia,:razon_social,:nit)";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( [
            'fecha_diligencia' => $usuario->getFecha_diligencia(),
            'razon_social' => $usuario->getRazon_social(),
            'nit' => $usuario->getNit()
        ] );
        return $this->cnn->lastInsertId();
    }

    public function consultar_preguntas( $tabla, $contenido ) {
        $sql = "SELECT * FROM  preguntas WHERE tabla=:tabla AND contenido=:contenido";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( [
            'tabla' => $tabla,
            'contenido' => $contenido
        ] );
        return $sentencia->fetchAll( PDO::FETCH_OBJ );
    }

    public function guardar_respuesta( $id_pregunta, $respuestas, $id_usuario ) {
        $sql = "INSERT INTO respuestas (id_pregunta,respuestas,id_usuario) 
                VALUES (:id_pregunta,:respuestas,:id_usuario)";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( [
            'id_pregunta' => $id_pregunta,
            'respuestas' => $respuestas,
            'id_usuario' => $id_usuario
        ] );
        return $this->cnn->lastInsertId();
    }
}
