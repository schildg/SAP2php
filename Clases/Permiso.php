<?php
include_once('DATA_CONF.php');
class Permiso extends SuperClase {
	function Permiso() {
		$this->CLASE_OBJETO='Permiso';
	}
	function usuarioAutorizado($comando,$user_id) {
		include_once ("Accion.php");
		include_once ("Usuario.php");
		$accion = new Accion();
		$usuario=new Usuario();
		$usuario=$usuario->buscar($user_id);
		$accion=$accion->buscarAccion($comando);
		$permiso= MyActiveRecord :: FindFirst('Permiso', "usuario_id = '$usuario->id' AND accion_id='$accion->id'");
		if ($permiso->habilitado == 1){
		   return true;
		}else{
		   return false;
		}
	}
	function autorizado($comando) {
		include_once ("Accion.php");
		include_once ("Usuario.php");
		$accion = new Accion();
		$usuario=new Usuario();
		$usuario=$usuario->usuario_logueado($usuario->user_sesion());
		$accion=$accion->buscarAccion($comando);
		$permiso= MyActiveRecord :: FindFirst('Permiso', "usuario_id = '$usuario->id' AND accion_id='$accion->id'");
		if ($permiso->habilitado == 1){
		   return true;
		}else{
		   return false;
		}
	}
	function leyenda() {
		return $this->habilitado;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "accion_id" => "accion que puede ejecutar",
                     "usuario_id" => "Usuario",
                     "habilitado" => "Habilitado",
                     );
        return $Campo[$campo];
	}
    function permisoUnico($persona,$accion){
		$unico = MyActiveRecord :: FindFirst('Permiso', "usuario_id = '$persona' AND accion_id = '$accion'");
		if($unico){
			return true;
		}else{
			return false;
		}
    }
	function save() {
		if (empty ($this->usuario_id))
			$this->add_error('usuario_id', 'Se le debe asignar un Usuario');
		if ($this->id ==0 and $this->permisoUnico($this->usuario_id,$this->accion_id))
			$this->add_error('usuario_id', 'ya existe la relacion');
		if (empty ($this->accion_id))
			$this->add_error('accion_id', 'Se le debe asignar una Accion');
		if( $this->get_errors() )
		{
			$_SESSION['errores']=$this->get_errors();
		}
		else{
			parent :: save();
		}
	}
}
?>
