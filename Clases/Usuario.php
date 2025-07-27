<?php
include_once('DATA_CONF.php');
include_once('Usuario_Establecimiento.php');
class Usuario extends SuperClase {
	function Usuario() {
		$this->CLASE_OBJETO='Usuario';
	}
	function user_sesion() {
		return $_SESSION['usuario'];
	}
	function user_establecimiento() {
		$usuario_establecimiento = New Usuario_Establecimiento();
		$usuario_establecimiento = $usuario_establecimiento->FindFirst('Usuario_Establecimiento', "usuario_id".$this->id);
		return $usuario_establecimiento->establecimiento_id;
	}
	function logueado() {
		return isset($_SESSION["usuario"]);
	}
	function usuario_logueado($user) {
		return MyActiveRecord :: FindFirst('Usuario', "login = '$user'");
	}
	function FindByLogin($login) {
		return MyActiveRecord :: FindFirst('Usuario', "login = '$login' AND habilitado > 0 ");
	}
	function leyenda() {
		return $this->id." - ".$this->Apellido.", ".$this->Nombre;
	}
	function guardarPsw($pass) {
		$this->pws = md5($pass);
	}
	function recuperarPsw() {
		return md5($this->pws);
	}
	function validarLogin($login, $pass) {
		$psw=md5($pass);
		$user = MyActiveRecord :: FindFirst('Usuario', "login = '$login' AND habilitado > 0 AND pws = '$psw'");
		if ($user) {
			return true;
		} else {
			return false;
		};
	}
    function loginUnico($login){
		$unico = MyActiveRecord :: FindFirst('Usuario', "login = '$login'");
		if($unico){
			return true;
		}else{
			return false;
		}
    }
	function save() {
		if ($this->id ==0 and $this->loginUnico($this->login))
			$this->add_error('login', 'El login ya existe');
		if (empty ($this->login))
			$this->add_error('login', 'El login no puede estar en blanco');
		if (empty ($this->Apellido))
			$this->add_error('Apellido', 'El Apellido no puede estar en blanco');
		if (empty ($this->menu_id))
			$this->add_error('menu_id', 'Se le debe asignar un menu');
		if (empty ($this->Nombre))
			$this->add_error('Nombre', 'El Nombre no puede estar en blanco');
				// if this object has registered errors, we back off and return false.
		if( $this->get_errors() )
		{
			$_SESSION['errores']=$this->get_errors();
		}
		else{
			parent :: save();
		};
		$usuario_establecimiento= New Usuario_Establecimiento();
		$usuario_establecimiento->usuario_id = $this->id;
		$usuario_establecimiento->establecimiento_id = $_SESSION['establecimiento'];
		$usuario_establecimiento= $usuario_establecimiento->buscarUser($this->id, $_SESSION['establecimiento']);
		$usuario_establecimiento->save();
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "Nombre" => "Nombre del Usuario",
                     "Apellido" => "Apellido del Usuario",
                     "email" => "E-mail",
                     "habilitado" => "Habilitado",
                     "login" => "Login",
                     "pws" => "Password",
                     "menu_id" => "Menu",
                     );
        return $Campo[$campo];
	}
}
?>
