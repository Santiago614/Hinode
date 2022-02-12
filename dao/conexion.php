<?php
//Configurar zona horaria de COlombia
date_default_timezone_set('America/Bogota');
$nombreHost = "localhost";
$nombreDB = "hinode";
$host = "mysql:host=$nombreHost; dbname=$nombreDB";
$usuario = "root";
$contrasena = "";

try {
    //Conexión exitosa
    $pdo = new PDO($host, $usuario, $contrasena);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Establece utf-8, para captura de tilde y eñes
    $pdo->query("SET NAMES 'utf8'");
} catch (\PDOException $th) {
    //Error conexión
    print "Error!" . $th->getMessage();
    die();
}
