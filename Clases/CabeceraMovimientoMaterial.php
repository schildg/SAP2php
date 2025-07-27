<?php
include_once('DATA_CONF.php');
class CabeceraMovimientoMaterial extends SuperClase{
	function CabeceraMovimientoMaterial() {
		$this->CLASE_OBJETO='CabeceraMovimientoMaterial';
	}
	function buscarExtendido($vmat_doc ,$vdoc_year) {
		$rela = MyActiveRecord :: FindFirst('CabeceraMovimientoMaterial',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function existe($vmat_doc ,$vdoc_year) {
		$rela = MyActiveRecord :: FindFirst('CabeceraMovimientoMaterial',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year'");
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
		$Campo=array("id" => "id","MAT_DOC" => "N�mero de documento material","DOC_YEAR" => "Ejercicio del documento de material","TR_EV_TYPE" => "Clase de operaci�n","PSTNG_DATE" => "Fecha de contabilizaci�n en el documento","REF_DOC_NO" => "N�mero de documento de referencia","VBELN" => "Entrega","WERKS" => "Centro","LGORT" => "Almac�n","WDATU" => "Fecha de la entrada de mercanc�as",
                     );
        return $Campo[$campo];
	}
};
?>
