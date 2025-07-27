<?php
include_once('DATA_CONF.php');
class Tabla extends SuperClase {
	function Tabla() {
		$this->CLASE_OBJETO='Tabla';
	}
	function valor($objeto,$campo) {
		return MyActiveRecord :: FindAll('Tabla', "objeto='$objeto' AND campo = '$campo' AND habilitado = 1",'numero ASC');
	}
	function campo($objeto,$campo,$valor) {
		//echo "objeto='$objeto' AND campo = '$campo' AND numero='$valor' AND habilitado = 1";
		$result = MyActiveRecord :: FindFirst('Tabla', "objeto='$objeto' AND campo = '$campo' AND numero='$valor' AND habilitado = 1",'numero ASC');
		return $result->nombre;
	}
	function leyenda() {
		return $this->id." - ".$this->objeto;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "campo" => "Campo de la tabla",
                     "numero" => "Numero especifico",
                     "nombre" => "Descripcion Completa",
                     "noco" => "Descripcion Corta",
                     "habilitado" => "Habilitado",
                     "objeto" => "Objeto al que pertenece",
                     );
        return $Campo[$campo];
	}
	function save() {
		if (empty ($this->campo))
			$this->add_error('campo', 'El campo de la tabla no debe estar vacio');
		if (empty ($this->nombre))
			$this->add_error('nombre', 'Se le debe asignar un nombre largo');
		if (empty ($this->noco))
			$this->add_error('noco', 'Se le debe asignar un nombre corto');
		if (empty ($this->objeto))
			$this->add_error('objeto', 'Se le debe asignar un objeto al que pertenece');
		if( $this->get_errors() )
		{
			$_SESSION['errores']=$this->get_errors();
		}
		else{
			parent :: save();
		}
	}
};
?>
