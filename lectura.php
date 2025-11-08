<HTML>
<HEAD>
<TITLE>lectura.php</TITLE>
</HEAD>
<BODY>
<h1><div align="center">Lectura de la tabla</div></h1>
<br>
<br>
<?php
//Conexion con la base
//$conex = mysqli_connect("localhost","root","root","registro"); 
include("con_db.php");
//Ejecutamos la sentencia SQL
$sql="SELECT * from datos";
		$result=mysqli_query($conex,$sql);

?>
<table align="center">
<tr>
<th>nombre</th>
<th>email</th>
<th>fecha_reg</th>
</tr>
<?php
//Mostramos los registros
while ($row=mysqli_fetch_array($result))
{
echo '<tr><td>'.$row["nombre"].'</td>';
echo '<td>'.$row["email"].'</td>';
echo '<td>'.$row["fecha_reg"].'</td></tr>';
}
mysqli_free_result($result)
?>
</table>

<div align="center">
<br> </br>
<a href="form.php">Añadir un nuevo registro</a><br>
<a href="actualizar1.php">Actualizar un registro existente</a><br>
<a href="borrar1.php">Borrar un registro</a><br>
</div>

</BODY>
</HTML>