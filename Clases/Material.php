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
		$Campo=array("id" => "id","MAKTG" => "Descripcion del material","MATNR" => "N�mero de material","ERSDA" => "Fecha de creaci�n","ERNAM" => "Nombre del responsable que ha a�adido el objeto","LAEDA" => "Fecha �ltima modificaci�n","AENAM" => "Nombre del responsable que ha modificado el objeto","MTART" => "Tipo de material","MBRSH" => "Ramo","MATKL" => "Grupo de art�culos","BISMT" => "N�mero de material antiguo","MEINS" => "Unidad de medida base","FERTH" => "Informaci�n de fabricaci�n/inspecci�n","FORMT" => "Formato DIN de nota de fabricaci�n","GROES" => "Tama�o/Dimensi�n","WRKST" => "Materia","NORMT" => "Denominaci�n de est�ndar (p.ej.DIN)","LABOR" => "Laboratorio/Oficina de proyectos","BRGEW" => "Peso bruto","NTGEW" => "Peso neto","GEWEI" => "Unidad de peso","VOLUM" => "Volumen","VOLEH" => "Unidad de volumen","BEHVO" => "Prescripci�n de envase","RAUBE" => "Condiciones de almacenaje","TEMPB" => "Indicador para condiciones de temperatura","SPART" => "Sector","EAN11" => "N�mero de art�culo europeo (EAN)","NUMTP" => "Tipo de n�mero del N�mero de Art�culo Europeo","LAENG" => "Longitud","BREIT" => "Ancho","HOEHE" => "Altura","MEABM" => "Unidad de medida para longitud/ancho/altura","ATTYP" => "Categor�a de material","MFRPN" => "N� pieza fabricante","MFRNR" => "N�mero de un fabricante",
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
