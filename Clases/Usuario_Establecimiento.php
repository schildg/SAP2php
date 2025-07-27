<?php
include_once('DATA_CONF.php');
include_once('Usuario.php');
include_once('Establecimiento.php');
class Usuario_Establecimiento extends SuperClase{
	function Usuario_Establecimiento() {
		$this->CLASE_OBJETO='Usuario_Establecimiento';
	}
	function leyenda() {
		return $this->id;
	}
	function buscarUser($vuser,$vesta) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"usuario_id  = '$vuser' AND establecimiento_id = '$vesta'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "usuario_id" => "Usuario",
                     "establecimiento_id" => "Establecimiento",
//                   "objeto_foraneo" => "Objeto Foraneo",
                     );
        return $Campo[$campo];
	}
};
?>
