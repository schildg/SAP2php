<?php
$smarty  = new Smarty();
include_once ("Clases/Tabla.php");
$tabla = new Tabla();
$usuario = new Usuario();
$permiso = new Permiso();
$aCcion = new Accion();
$relacion=$usuario;

if (isset ($_POST['usuario-id'])) {
	$usuario_id = $_POST['usuario-id'];
} else {
	$usuario_id = $_GET['usuario-id'];
}
if (isset ($_POST['accion-id'])) {
	$accion_id = $_POST['accion-id'];
} else {
	$accion_id = $_GET['accion-id'];
}

switch ($accion) {
	case "manPermisos-DesHab" :
		$usuario=$usuario->buscar($usuario_id);
		$aCcion=$aCcion->buscar($accion_id);
		$permiso=$permiso->FindFirst('Permiso', "usuario_id = '$usuario->id' AND accion_id='$aCcion->id'");
		$permiso->habilitado = false;
		$permiso->save();
		break;
	case "manPermisos-Hab" :
		$usuario=$usuario->buscar($usuario_id);
		$aCcion=$aCcion->buscar($accion_id);
		$permiso=$permiso->FindFirst('Permiso', "usuario_id = '$usuario->id' AND accion_id='$aCcion->id'");
		if(!$permiso){
			$permiso = new Permiso();
			$permiso->usuario_id=$usuario->id;
			$permiso->accion_id=$aCcion->id;
		}
		$permiso->habilitado = true;
		$permiso->save();
		break;
	case "manPermisos" :
		if(!$usuario_id){
			$usuario=$usuario->usuario_logueado($usuario->user_sesion());
			$usuario_id=$usuario->id;
		};
		break;
};



$usuario=$usuario->buscar($usuario_id);
$acciones=$aCcion->FindAll('Accion','habilitado=1','id DESC');

$smarty->assign("self", $self);
$smarty->assign("permiso", $permiso);
$smarty->assign("acciones", $acciones);
$smarty->assign("aCcion", $aCcion);
$smarty->assign("usuario", $usuario);
$smarty->assign("relacion", $relacion);

$smarty->display('manPermisos.tpl');
?>



