<?php

class Conexion {

    public static function conectar() {
        $cnn = new PDO('mysql:host=localhost;port=3306;dbname=dexcon', 'root', '');
        $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnn->exec("set names utf8");
        return $cnn;
    }

}

