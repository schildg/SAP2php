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
		$Campo=array("id" => "id","MAT_DOC" => "N�mero de documento material","DOC_YEAR" => "Ejercicio del documento de material","TR_EV_TYPE" => "Clase de operaci�n","PSTNG_DATE" => "Fecha de contabilizaci�n en el documento","REF_DOC_NO" => "N�mero de documento de referencia","EXIDV" => "Identificaci�n externa de la unidad de manipulaci�","VENUM" => "N�m.interno de un.manipulaci�n","VBELN" => "Entrega","POSNR" => "Posici�n de entrega","UNVEL" => "Unidad de manipulaci�n inferior","VEMNG" => "Cantidad base embalada en posici�n de unidad manip","VEMEH" => "Unidad de medida base de cantidad embalada (VEMNG)","MATNR" => "N�mero de material","CHARG" => "N�mero de lote","WERKS" => "Centro","LGORT" => "Almac�n","WDATU" => "Fecha de la entrada de mercanc�as","VFDAT" => "Fecha de caducidad o fecha preferente de consumo","HU_LGORT" => "Contenido ubicado en almac�n gestionado por UMp","XCHAR" => "Posici�n de UMp tiene una asignaci�n libre",
                     );
        return $Campo[$campo];
	}
};
?>
