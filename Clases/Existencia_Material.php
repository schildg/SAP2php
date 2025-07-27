<?php
include_once('DATA_CONF.php');
class Existencia_Material extends SuperClase{
	function Existencia_Material() {
		$this->CLASE_OBJETO='Existencia_Material';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","MATNR" => "Número de material","C_WERKS" => "Centro","C_LGORT" => "Almacén","PSTAT" => "Status de actualización","LVORM" => "Marcar para borrado material a nivel de almacén","LFGJA" => "Ejercicio del período actual","LFMON" => "Período actual (período contable)","SPERR" => "Indicador de bloqueo para inventario","LABST" => "Stock valorado de libre utilización","UMLME" => "Stock en traslado (de almacén a almacén)","INSME" => "Stock en control de calidad","EINME" => "Stock total de lotes (todos) no libres","SPEME" => "Stock bloqueado","RETME" => "Stock bloqueado de devoluciones","VMLAB" => "Stock valorado de utilización libre de periodo ant","VMUML" => "Stock en traslado a otro almacén del periodo anter","VMINS" => "Stock en inspección de calidad del periodo precede","VMEIN" => "Stock no libre del periodo anterior","VMSPE" => "Stock bloqueado del periodo anterior","VMRET" => "Stock bloqueado de devoluciones del período anteri","KZILL" => "Indicador de inventario para stock almacén año act","KZILQ" => "Ind. de invent. para stock en control calidad año ","KZILE" => "Indicador de inventario para stock de utilización ","KZILS" => "Indicador de inventario para stock bloqueado","KZVLL" => "Ind.de inventario para stock almacén en el período","KZVLQ" => "Ind-inventario para stock en control-calidad en pe","KZVLE" => "Ind-inventario para stock utiliz. restring en peri","KZVLS" => "Ind. de inventario para stock bloqueado en el peri","DISKZ" => "Indicador de planificación de necesidades de almac","LSOBS" => "Clase aprovisionam. especial almacén","LMINB" => "Punto de pedido para planificación de necesidades","LBSTF" => "Cantidad de reposición para planif.necesidades de ","HERKL" => "País de origen del material (origen CCI)","EXPPG" => "Indicador de preferencia (desactiv.)","EXVER" => "Indicador de exportación (desactiv.)","LGPBE" => "Ubicación","KLABS" => "Stock en consignación de libre utilización","KINSM" => "Stock de consignación en control de calidad","KEINM" => "Stock consi no libre","KSPEM" => "Stock artículos en consignación bloqueado","DLINL" => "Fecha último recuento inventario stock libre utili","PRCTL" => "Centro de beneficio","ERSDA" => "Fecha de creación","VKLAB" => "Valor de stocks de un material de valor al precio ","VKUML" => "Valor de venta en el traslado (de almacén a almacé","LWMKB" => "Área de picking para lean WM","MDRUE" => "El reg.MARDH p.per.ante-anterior del per.MARD ya e","MDJIN" => "Ejercicio del indicador de inventario actual",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vMATNR,$vWERKS,$vLGORT) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"MATNR= '$vMATNR' AND C_WERKS='$vWERKS' AND C_LGORT='$vLGORT'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function save(){
		$cen = New Centro();
		$cen = $cen->buscarExtendido($this->C_WERKS);
		$this->WERKS=$cen->NAME1;
		$alm = New Almacen();
		$alm = $alm->buscarExtendido($this->C_WERKS,$this->C_LGORT);
		$this->LGORT=$alm->LGOBE;
		
		parent :: save();
	}
	
};
?>
