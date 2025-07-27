<?php
$self = $_SERVER['PHP_SELF'];
include_once ("conector.php");
require_once( 'Smarty.class.php');
include("Usuario.php");
$usuario = new Usuario();
$user = $_POST['user'];
$pass = $_POST['pass'];
ini_set("session.use_trans_sid","0");
ini_set("session.use_only_cookies","1");
if (isset ($_POST['accion'])) {
	$accion = $_POST['accion'];
} else {
	$accion = $_GET['accion'];
}

session_name("loginUsuario");
session_start();

switch ($accion) {
	case "login" :
		if ($usuario->validarLogin($user, $pass)) {
			session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);
			$_SESSION["autentificado"]= "SI";
			$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
			$_SESSION['usuario'] = $user;
			$_SESSION['establecimiento'] = $usuario->user_establecimiento();
		}
		break;
	case "close" :
		session_unset();
		session_destroy();

		break;
};
if ($_SESSION["autentificado"] = "SI") {
session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0);
$fechaGuardada = $_SESSION["ultimoAcceso"];
$ahora = date("Y-n-j H:i:s");

if ($_SERVER["HTTP_REFERER"] != $_SESSION['url_anterior']){
	$_SESSION['url_ante_ultima']=$_SESSION['url_anterior'];
	$_SESSION['url_anterior'] =$_SERVER["HTTP_REFERER"]; 
} 

$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
if($tiempo_transcurrido >= 3600) {
	if(isset($_SESSION["usuario"])){	
		session_unset();
		session_destroy(); 
	}
}else {
	$_SESSION["ultimoAcceso"] = $ahora;
	}
}

include_once ("sesion.html");
?>