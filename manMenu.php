<?php
if (isset ($_POST['accion'])) {
	$accion = $_POST['accion'];
} else {
	$accion = $_GET['accion'];
}
echo "<li><a href=\"$self\" class=\"product\">P&#225;gina principal</a></li>";
echo '<li><a href="http://www.opensource.org/licenses/gpl-2.0.php" class="product">Licencia</a></li>';
if(isset($_SESSION["usuario"])){	
include_once ("Clases/Menu.php");
include_once ("Clases/Accion.php");
include_once ("Clases/Accion_Menu.php");
include_once ("Clases/Menu_Menu.php");
include_once ("Clases/Usuario.php");
$user = $_SESSION["usuario"];
$usuario = new Usuario;
$usuario = $usuario->FindByLogin($user);

$menu = new Menu();
$menu = $menu->buscarId($usuario->menu_id);
$i=0;
$menu->crearMenues($i);

}
?>
