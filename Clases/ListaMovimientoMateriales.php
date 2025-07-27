<?php
include_once('DATA_CONF.php');
class ListaMovimientoMateriales extends SuperClase{
	function ListaMovimientoMateriales() {
		$this->CLASE_OBJETO='ListaMovimientoMateriales';
	}
	function leyenda() {
		return $this->id;
	}
	function buscarExtendido($vmat_doc ,$vdoc_year ,$vtr_ev_type ,$vexidv ,$vvenum ,$vunvel ,$vmatnr ,$vcharg) {
		$vcharg=trim($vcharg);
		$rela = MyActiveRecord :: FindFirst('ListaMovimientoMateriales',"mat_doc  = '$vmat_doc' AND doc_year  = '$vdoc_year' AND tr_ev_type  = '$vtr_ev_type' AND exidv  = '$vexidv' AND venum  = '$vvenum' AND unvel  = '$vunvel' AND matnr  = '$vmatnr' AND charg = '$vcharg'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","MAT_DOC" => "Número de documento material","DOC_YEAR" => "Ejercicio del documento de material","TR_EV_TYPE" => "Clase de operación","PSTNG_DATE" => "Fecha de contabilización en el documento","REF_DOC_NO" => "Número de documento de referencia","EXIDV" => "Identificación externa de la unidad de manipulació","VENUM" => "Núm.interno de un.manipulación","VBELN" => "Entrega","POSNR" => "Posición de entrega","UNVEL" => "Unidad de manipulación inferior","VEMNG" => "Cantidad base embalada en posición de unidad manip","VEMEH" => "Unidad de medida base de cantidad embalada (VEMNG)","MATNR" => "Número de material","CHARG" => "Número de lote","WERKS" => "Centro","LGORT" => "Almacén","WDATU" => "Fecha de la entrada de mercancías","VFDAT" => "Fecha de caducidad o fecha preferente de consumo","HU_LGORT" => "Contenido ubicado en almacén gestionado por UMp","XCHAR" => "Posición de UMp tiene una asignación libre",
                     );
        return $Campo[$campo];
	}
};
?>
