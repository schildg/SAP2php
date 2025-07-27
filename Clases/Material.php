<?php
include_once('DATA_CONF.php');
class Material extends SuperClase{
	function Material() {
		$this->CLASE_OBJETO='Material';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","MAKTG" => "Descripcion del material","MATNR" => "Número de material","ERSDA" => "Fecha de creación","ERNAM" => "Nombre del responsable que ha añadido el objeto","LAEDA" => "Fecha última modificación","AENAM" => "Nombre del responsable que ha modificado el objeto","MTART" => "Tipo de material","MBRSH" => "Ramo","MATKL" => "Grupo de artículos","BISMT" => "Número de material antiguo","MEINS" => "Unidad de medida base","FERTH" => "Información de fabricación/inspección","FORMT" => "Formato DIN de nota de fabricación","GROES" => "Tamaño/Dimensión","WRKST" => "Materia","NORMT" => "Denominación de estándar (p.ej.DIN)","LABOR" => "Laboratorio/Oficina de proyectos","BRGEW" => "Peso bruto","NTGEW" => "Peso neto","GEWEI" => "Unidad de peso","VOLUM" => "Volumen","VOLEH" => "Unidad de volumen","BEHVO" => "Prescripción de envase","RAUBE" => "Condiciones de almacenaje","TEMPB" => "Indicador para condiciones de temperatura","SPART" => "Sector","EAN11" => "Número de artículo europeo (EAN)","NUMTP" => "Tipo de número del Número de Artículo Europeo","LAENG" => "Longitud","BREIT" => "Ancho","HOEHE" => "Altura","MEABM" => "Unidad de medida para longitud/ancho/altura","ATTYP" => "Categoría de material","MFRPN" => "Nº pieza fabricante","MFRNR" => "Número de un fabricante",
		"COSTO" => "Costo","PRECIO_PISO" => "Precio Minimo/Piso","PRECIO_LISTADO" => "Precio de Listado/Promedio",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vmaterial) {
		if(is_numeric($vmaterial)){
			$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"MATNR = lpad($vmaterial,18,'0')");
		}else{
			$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"MATNR = '$vmaterial'");
		}
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function existe($vmaterial) {
		if(is_numeric($vmaterial)){
			$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"MATNR = lpad($vmaterial,18,'0')");
		}else{
			$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"MATNR = '$vmaterial'");
		}
		if (!$rela){
			return false;
		}else{
			return true;
		};
		
	}
	function tieneCentro($vmatnr) {
		$rela = MyActiveRecord :: FindFirst("Existencia_Material","MATNR = '$vmatnr'");
		if (!$rela){
			return false;
		}else{
			return true;
		};
		
	}
	function save(){
		if (is_numeric($this->MATNR)){
			$this->MATNR=str_pad((int)$this->MATNR, 18, "0", STR_PAD_LEFT);
		}
		$this->MONEDA='USD';
		$rela=MyActiveRecord :: FindFirst("Grupo_Articulo","MATKL = '$this->MATKL'");
		if (!$rela){
			$this->WGBEZ='';
		}else{
			$this->WGBEZ=$rela->WGBEZ;
		};
		return parent :: save();
	}
	
	
};
?>
