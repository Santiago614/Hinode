<?php
require '../dao/conexion.php';
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];
$categoria = $_POST['categoria'];
$documentoIdentidad = $_POST['usuario'];

//Recogemos el archivo enviado por el formulario
$imagen = $_FILES['imagen']['name'];
//Si el imagen contiene algo y es diferente de vacio
if (isset($imagen) && $imagen != "") {
    //Obtenemos algunos datos necesarios sobre el imagen
    $tipo = $_FILES['imagen']['type'];
    $tamano = $_FILES['imagen']['size'];
    $temp = $_FILES['imagen']['tmp_name'];
    //Se comprueba si el imagen a cargar es correcto observando su extensión y tamaño
    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
        echo '<div><b>Error. La extensión o el tamaño de los imagens no es correcta.<br/>
     - Se permiten imagens .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
    } else {
        //Si la imagen es correcta en tamaño y tipo
        //Se intenta subir al servidor
        if (move_uploaded_file($temp, '../assets/img/' . $imagen)) {
            //Cambiamos los permisos del imagen a 777 para poder modificarlo posteriormente
            chmod('../assets/img/' . $imagen, 0777);

            //Guardar registro en la BD
            $sql = "INSERT INTO tblproducto VALUES (null,:nombre,:descripcion,:precio,:usuario,:categoria,:imagen)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindValue(":nombre", $nombre);
            $consulta->bindValue(":descripcion", $descripcion);
            $consulta->bindValue(":precio", $costo);
            $consulta->bindValue(":usuario", $documentoIdentidad);
            $consulta->bindValue(":categoria", $categoria);
            $consulta->bindValue(":imagen", $imagen);
            $consulta->execute();

             //Registro almacenado correctamente
             echo "<script>alert('¡El producto se guardó correctamente!');</script>";
             /* Redirigir después de almacenar la información */
             echo "<script> document.location.href='../dashboard/index.php';</script>";
        } else {
            //Si no se ha podido subir la imagen, mostramos un mensaje de error
            echo "<script>alert('¡Ocurrió algún error. No pudo guardarse el registro!');</script>";
            echo "<script> document.location.href='../dashboard/index.php';</script>";
        }
    }
}
