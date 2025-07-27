<?php
include_once('DATA_CONF.php');
include_once('Clase_Movimiento.php');
class LineaMovimientoMaterial extends SuperClase{
	function LineaMovimientoMaterial() {
		$this->CLASE_OBJETO='LineaMovimientoMaterial';
	}
	function buscarExtendido($vmat_doc ,$vdoc_year ,$vmatnr) {
		$rela = MyActiveRecord :: FindFirst('LineaMovimientoMaterial',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year' AND matnr  = '$vmatnr'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function existe($vmat_doc ,$vdoc_year ,$vmatnr) {
		$rela = MyActiveRecord :: FindFirst('LineaMovimientoMaterial',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year' AND matnr  = '$vmatnr'");
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
		$Campo=array("id" => "id","MAT_DOC" => "Número de documento material","DOC_YEAR" => "Ejercicio del documento de material","MOVE_TYPE" => "Clase de Movimiento","VEMNG" => "Cantidad base embalada en posición de unidad manip","VEMEH" => "Unidad de medida base de cantidad embalada (VEMNG)","MATNR" => "Número de material",
                     );
        return $Campo[$campo];
	}
};
?>
