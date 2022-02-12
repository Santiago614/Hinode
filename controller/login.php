<?php
require '../dao/conexion.php';
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sqlLogin = "SELECT correoUsuario, contrasenaUsuario FROM tblusuario 
WHERE correoUsuario=:correo AND contrasenaUsuario=:contrasena";
$consultaLogin = $pdo->prepare($sqlLogin);
$consultaLogin->bindValue(":correo", "$correo");
$consultaLogin->bindValue(":contrasena", "$contrasena");
$consultaLogin->execute();
$resultadoLogin = $consultaLogin->rowCount();
if ($resultadoLogin) {
    session_start();
    $_SESSION['correo'] = $correo;
    echo "<script> document.location.href='../dashboard/index.php';</script>";
} else {
    echo "<script>alert('¡Contraseñas erróneas, verifica e intenta nuevamente!');</script>";
    echo "<script> document.location.href='../login.php';</script>";
}
