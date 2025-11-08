<HTML>
<HEAD>
<TITLE>Actualizar2.php</TITLE>
</HEAD>
<BODY>
<?php
//Conexion con la base
//$conex = mysqli_connect("localhost","root","","registro"); 
include("con_db.php");

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$nombrenew = $_POST['nombrenew'];
date_default_timezone_set ("America/Argentina/Buenos_Aires");
$fechareg = date("d/m/y/H:i");

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update datos Set email='$email',nombre='$nombrenew',fecha_reg='$fechareg' Where nombre='$nombre'";
mysqli_query($conex,$sSQL);
?>

<h1><div align="center">Registro Actualizado</div></h1>
<div align="center"><a href="lectura.php">Visualizar el contenido de la base</a></div>

</BODY>
</HTML>