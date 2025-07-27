<?php
include_once ("Clases/Usuario.php");
$self = $_SERVER['PHP_SELF'];
$usuario = new Usuario();
if ($usuario->logueado()) {
echo "<a href=\"$self?accion=cambioPassword\"><img src=\"css-imgs/key.png\" alt=\"Cambiar password \"/>Cambiar password</a>";
echo "<a href=\"$self?accion=close\"><img src=\"css-imgs/cerrar-sesion.png\" alt=\"Cerrar Sesion \"/>Cerrar Sesion</a>";
}else{
echo "<a href=\"$self?accion=loguear\"><img src=\"css-imgs/iniciar-sesion.png\" alt=\"Iniciar Sesion \"/>Iniciar Sesion</a>";
};
?>