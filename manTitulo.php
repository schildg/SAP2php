<?php
if(isset($_SESSION["usuario"])){	
include_once ("Clases/Establecimiento.php");
$establecimiento = New Establecimiento();
$establecimiento = $establecimiento->buscarId($_SESSION["establecimiento"]);
echo $establecimiento->nombre;
}
?>
