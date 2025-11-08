<HTML>
<HEAD>
<TITLE>Actualizar1.php</TITLE>
</HEAD>
<BODY>
<div align="center">
<h1>Actualizar un registro</h1>
<br>
<?php
//Conexion con la base
include("con_db.php");
//$conex = mysqli_connect("localhost","root","","registro"); 

echo '<FORM METHOD="POST" ACTION="actualizar2.php">Nombre<br>';

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Select nombre From datos Order By nombre";
$result=mysqli_query($conex,$sSQL);

echo '<select name="nombre">';

//Generamos el menu desplegable
while ($row=mysqli_fetch_array($result))
{echo '<option>'.$row["nombre"];}
?>
</select>
<br><br><br>
nomnbre<br>
<INPUT TYPE="TEXT" NAME="nombrenew"><br>
<br>
email<br>
<INPUT TYPE="TEXT" NAME="email"><br><br>
<INPUT TYPE="SUBMIT" value="Actualizar">
</FORM>

<a href="lectura.php">Listar los  registros</a><br>
<a href="form.php">Añadir un nuevo registro</a><br>
<a href="borrar1.php">Borrar un registro</a><br>
</div>
</BODY>
</HTML>