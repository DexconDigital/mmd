<?php

class Usuario {

    private $id_usuario;
    private $fecha_diligencia;
    private $razon_social;
    private $nit;

    //GET

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getFecha_diligencia() {
        return $this->fecha_diligencia;
    }

    function getRazon_social() {
        return $this->razon_social;
    }

    function getNit() {
        return $this->nit;
    }

    //SET

    function setId_usuario( $id_usuario ) {
        $this->id_usuario = $id_usuario;
    }

    function setFecha_diligencia( $fecha_diligencia ) {
        $this->fecha_diligencia = $fecha_diligencia;
    }

    function setRazon_social( $razon_social ) {
        $this->razon_social = $razon_social;
    }

    function setNit( $nit ) {
        $this->nit = $nit;
    }
}
