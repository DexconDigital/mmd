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
        $sql = "select * from preguntas WHERE tabla=:tabla AND contenido=:contenido";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( [
            'tabla' => $tabla,
            'contenido' => $contenido
        ] );
        return $sentencia->fetchAll( PDO::FETCH_OBJ );
    }

    public function consultar_respuestas( $tabla, $contenido, $id_usuario ) {
        $sql = "select prg.*, res.respuestas, res.id_usuario, res.id_respuestas from preguntas prg LEFT JOIN respuestas res on prg.id_pregunta = res.id_pregunta 
                WHERE prg.tabla=:tabla AND prg.contenido=:contenido AND res.id_usuario=:id_usuario";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( [
            'tabla' => $tabla,
            'contenido' => $contenido,
            'id_usuario' => $id_usuario
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

    public function modificar_respuesta( $id_respuestas, $respuestas ) {
        $sql = "UPDATE respuestas SET respuestas=:respuestas WHERE id_respuestas=:id_respuestas";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( [
            'id_respuestas' => $id_respuestas,
            'respuestas' => $respuestas
        ] );
        return $this->cnn->lastInsertId();
    }

    public function consultar_datos( $id_usuario ) {
        $sql = "SELECT res.id_pregunta, prg.tabla, prg.preguntas, prg.calculos_1, prg.contenido, prg.estandar, res.respuestas FROM preguntas prg INNER JOIN respuestas res on res.id_pregunta = prg.id_pregunta WHERE res.id_usuario =:id_usuario ORDER BY (prg.tabla)";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( [
            'id_usuario' => $id_usuario
        ] );
        return $sentencia->fetchAll( PDO::FETCH_OBJ );
    }

    public function consultar_usuario( $id_usuario ) {
        $sql = "SELECT razon_social, nit FROM usuario WHERE id_usuario =:id_usuario";
        $sentencia = $this->cnn->prepare( $sql );
        $sentencia->execute( [
            'id_usuario' => $id_usuario
        ] );
        return $sentencia->fetch( PDO::FETCH_OBJ );
    }
}
