<HTML>
<HEAD>
<TITLE>Borrar2.php</TITLE>
</HEAD>
<BODY>
<?php
//Conexion con la base
//$conex = mysqli_connect("localhost","root","","registro"); 
include("con_db.php");
//


//Creamos la sentencia SQL y la ejecutamos
$sSQL="Delete From datos Where nombre='{$_POST["nombre"]}'";
mysqli_query($conex,$sSQL);
?>

<h1><div align="center">Registro Borrado</div></h1>
<div align="center"><a href="lectura.php">Visualizar el contenido de la base</a></div>

</BODY>
</HTML>