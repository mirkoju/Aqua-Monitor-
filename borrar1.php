<HTML>
<HEAD>
<TITLE>Borrar1.php</TITLE>
</HEAD>
<BODY>
<div align="center">
<h1>Borrar un registro</h1>
<br>

<?php
//Conexion con la base
//$conex = mysqli_connect("localhost","root","","registro"); 
include("con_db.php");

echo '<FORM METHOD="POST" ACTION="borrar2.php">nombre<br>';

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Select nombre From datos Order By nombre";
$result=mysqli_query($conex,$sSQL);


echo '<select name="nombre">';

//Mostramos los registros en forma de menú desplegable
while ($row=mysqli_fetch_array($result))
{
  echo '<option>'.$row["nombre"];
}
mysqli_free_result($result)
?>

</select>
<br>
<INPUT TYPE="SUBMIT" value="Borrar">
</FORM>
</div>

</BODY>
</HTML>