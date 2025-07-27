<?php
include_once('DATA_CONF.php');
class HUMovimientoMaterial extends SuperClase{
	function HUMovimientoMaterial() {
		$this->CLASE_OBJETO='HUMovimientoMaterial';
	}
	function buscarExtendido($vmat_doc ,$vdoc_year ,$vmatnr, $vcharg ,$vexidv) {
		$vcharg=trim($vcharg);
		$rela = MyActiveRecord :: FindFirst('HUMovimientoMaterial',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year' AND matnr  = '$vmatnr' AND charg = '$vcharg' AND exidv = '$vexidv'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function existe($vmat_doc ,$vdoc_year ,$vmatnr, $vcharg ,$vexidv) {
		$vcharg=trim($vcharg);
		$rela = MyActiveRecord :: FindFirst('HUMovimientoMaterial',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year' AND matnr  = '$vmatnr' AND charg = '$vcharg' AND exidv = '$vexidv'");
		if (!$rela){
			return false;
		}else{
			return true;
		};
		
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","MAT_DOC" => "Número de documento material","DOC_YEAR" => "Ejercicio del documento de material","MATNR" => "Número de material","CHARG" => "Número de lote","EXIDV" => "Identificación externa de la unidad de manipulació","VEMNG" => "Cantidad base embalada en posición de unidad manip","VEMEH" => "Unidad de medida base de cantidad embalada (VEMNG)",
                     );
        return $Campo[$campo];
	}
};
?>
