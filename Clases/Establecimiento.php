<?php
include_once('DATA_CONF.php');
class Establecimiento extends SuperClase{
	function Establecimiento() {
		$this->CLASE_OBJETO='Establecimiento';
	}
	function leyenda() {
		return $this->id." - ".$this->nombre." - ".$this->direccion;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "nombre" => "Nombre del Establecimiento",
                     "nombre_abreviado" => "Nombre abreviado del Establecimiento",
                     "direccion" => "Direccion del Establecimiento",
                     "logo_1" => "Logo 1",
                     "logo_2" => "Logo 2",
                     "tipo" => "Tipo",
                     "nivel" => "Nivel",
                     "img_izq" => "Imagen Izquierda",
                     "img_der" => "Imagen Derecha"
                     );
        return $Campo[$campo];
	}
	function save() {
		if (empty ($this->nombre))
			$this->add_error('Establecimiento', 'El nombre del establecimiento no puede estar en blanco');
		if (empty ($this->direccion))
			$this->add_error('Establecimiento', 'La direccion del establecimiento no puede estar en blanco');
		if (empty ($this->nombre_abreviado))
			$this->add_error('Establecimiento', 'El nombre abreviado del establecimiento no puede estar en blanco');
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
