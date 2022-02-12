<?php
require '../dao/conexion.php';
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['costo'];
$categoria = $_POST['categoria'];
$id = $_POST['idProducto'];

$sqlActualizarProducto = "UPDATE tblproducto SET nombreProducto=:nombre,descripcionProducto=:descripcion,
precioProducto=:precio,categoriaProducto=:categoria 
WHERE idProducto=:id";
$consultaActualizarProducto = $pdo->prepare($sqlActualizarProducto);
$consultaActualizarProducto->bindValue(":nombre", $nombre);
$consultaActualizarProducto->bindValue(":descripcion", $descripcion);
$consultaActualizarProducto->bindValue(":precio", $precio);
$consultaActualizarProducto->bindValue(":categoria", $categoria);
$consultaActualizarProducto->bindValue(":id", $id);
$consultaActualizarProducto->execute();
echo "<script>alert('¡Registro actualizado correctamente!');</script>";
echo "<script> document.location.href='../dashboard/index.php';</script>";
