<?php
require '../dao/conexion.php';
$id = $_POST['idProducto'];

$sqlBorrarProducto = "DELETE FROM tblProducto WHERE idProducto=:id";
$consultarBorrarProducto = $pdo->prepare($sqlBorrarProducto);
$consultarBorrarProducto->bindValue(":id", $id);
$consultarBorrarProducto->execute();
echo "<script>alert('¡Registro eliminado correctamente!');</script>";
echo "<script> document.location.href='../dashboard/index.php';</script>";