<?php
include_once ("Clases/Usuario.php");
$smarty = new Smarty();
$usuario = new Usuario();
$OBJETO = 'Usuario';
switch ($accion) {
	case "cambioPassword" :
		$user = $usuario->user_sesion();
		$usuario = $usuario->FindByLogin($user);
		$smarty->assign("usuario", $usuario);
		$smarty->assign("self", $self);
		$smarty->display('CambioPassword.tpl');
		break;
	case "cambiarPassword" :
		$user = $usuario->user_sesion();
		$usuario = $usuario->FindByLogin($user);
	if ($_POST["pass1"] != $_POST["pass2"]) {
		$error[1] = "Las Claves son distintas por favor ingreselas nuevamente";
		$_SESSION['errores'] = $error;
		$smarty->assign("usuario", $usuario);
		$smarty->assign("self", $self);
		$smarty->display('CambioPassword.tpl');
	} else {
		if (md5($_POST["passAnt"]) != $usuario->pws) {
			$error[1] = "La Clave ingresada no coicide con la clave actual";
			$_SESSION['errores'] = $error;
			$smarty->assign("usuario", $usuario);
			$smarty->assign("self", $self);
			$smarty->display('CambioPassword.tpl');
		} else {
			$usuario->guardarPsw($_POST["pass1"]);
			$usuario->save();
		}
	};
		
		break;
};

?>