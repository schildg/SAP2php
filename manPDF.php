<?php
include_once ("conector.php");
if (isset ($_POST['accion'])) {
	$accion = $_POST['accion'];
} else {
	$accion = $_GET['accion'];
}
session_name("loginUsuario");
session_start();
setlocale(LC_TIME,'sp');
$SESSION['usuario']=$_COOKIE["loginUsuario"];
$self = $_SERVER['PHP_SELF'];
include_once ("Clases/Permiso.php");
include_once ("Clases/Menu.php");
include_once ("funciones.php");
$permiso = new Permiso();
if($permiso->autorizado($accion)){
	include_once ("Clases/Accion.php");
	$comando = new Accion();
	include($comando->modulo($accion));
}else{
		?>
			<form action="<?php echo($self); ?>" method="post">
			   <table summary="informacion de sesion" border="0"   align="center">
			    <tbody>
				    <tr>
				      <th><img 	src="css-imgs/error.png"/> 
				      </th>
				      <th><h1>   Disculpe, pero Usd. no puede ejecutar este modulo!</h1> 
				      </th>
				    </tr>
				    <tr><th></th><th><h2>   consulte informacion del comando <?php echo($accion); ?></h2></th></tr> 
				</tbody></table>
			 </form>
	<?php
	
}

?>