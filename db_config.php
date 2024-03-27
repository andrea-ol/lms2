<?php
    /*
    CONFIGURACION DE CONEXION A LA BASE DE DATOS LMS
    */
    $password = "1234";
    $usuario = "postgres";
    $nombreBaseDeDatos = "zajuna";
    # Puede ser 127.0.0.1 o el nombre de tu equipo; o la IP de un servidor remoto
    $rutaServidor = "localhost";
    $puerto = 5432;
    try {
        $conn = new PDO("pgsql:host=$rutaServidor;port=$puerto;dbname=$nombreBaseDeDatos", $usuario, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    } catch (Exception $e) {
        echo "Ocurrió un error con la base de datos: " . $e->getMessage();
    }
?>