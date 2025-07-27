<?php
include_once('DATA_CONF.php');
class LoteMovimientoMaterial extends SuperClase{
	function LoteMovimientoMaterial() {
		$this->CLASE_OBJETO='LoteMovimientoMaterial';
	}
	function buscarExtendido($vmat_doc ,$vdoc_year ,$vmatnr, $vcharg) {
		$vcharg=trim($vcharg);
		$rela = MyActiveRecord :: FindFirst('LoteMovimientoMaterial',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year' AND matnr  = '$vmatnr' AND charg = '$vcharg'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function existe($vmat_doc ,$vdoc_year ,$vmatnr, $vcharg) {
		$vcharg=trim($vcharg);
		$rela = MyActiveRecord :: FindFirst('LoteMovimientoMaterial',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year' AND matnr  = '$vmatnr' AND charg = '$vcharg'");
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
		$Campo=array("id" => "id","MAT_DOC" => "Número de documento material","DOC_YEAR" => "Ejercicio del documento de material","MATNR" => "Número de material","CHARG" => "Número de lote","VEMNG" => "Cantidad base embalada en posición de unidad manip","VEMEH" => "Unidad de medida base de cantidad embalada (VEMNG)","VFDAT" => "Fecha de caducidad o fecha preferente de consumo",
                     );
        return $Campo[$campo];
	}
};
?>
