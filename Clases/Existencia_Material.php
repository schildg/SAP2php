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
		$Campo=array("id" => "id","MATNR" => "N�mero de material","C_WERKS" => "Centro","C_LGORT" => "Almac�n","PSTAT" => "Status de actualizaci�n","LVORM" => "Marcar para borrado material a nivel de almac�n","LFGJA" => "Ejercicio del per�odo actual","LFMON" => "Per�odo actual (per�odo contable)","SPERR" => "Indicador de bloqueo para inventario","LABST" => "Stock valorado de libre utilizaci�n","UMLME" => "Stock en traslado (de almac�n a almac�n)","INSME" => "Stock en control de calidad","EINME" => "Stock total de lotes (todos) no libres","SPEME" => "Stock bloqueado","RETME" => "Stock bloqueado de devoluciones","VMLAB" => "Stock valorado de utilizaci�n libre de periodo ant","VMUML" => "Stock en traslado a otro almac�n del periodo anter","VMINS" => "Stock en inspecci�n de calidad del periodo precede","VMEIN" => "Stock no libre del periodo anterior","VMSPE" => "Stock bloqueado del periodo anterior","VMRET" => "Stock bloqueado de devoluciones del per�odo anteri","KZILL" => "Indicador de inventario para stock almac�n a�o act","KZILQ" => "Ind. de invent. para stock en control calidad a�o ","KZILE" => "Indicador de inventario para stock de utilizaci�n ","KZILS" => "Indicador de inventario para stock bloqueado","KZVLL" => "Ind.de inventario para stock almac�n en el per�odo","KZVLQ" => "Ind-inventario para stock en control-calidad en pe","KZVLE" => "Ind-inventario para stock utiliz. restring en peri","KZVLS" => "Ind. de inventario para stock bloqueado en el peri","DISKZ" => "Indicador de planificaci�n de necesidades de almac","LSOBS" => "Clase aprovisionam. especial almac�n","LMINB" => "Punto de pedido para planificaci�n de necesidades","LBSTF" => "Cantidad de reposici�n para planif.necesidades de ","HERKL" => "Pa�s de origen del material (origen CCI)","EXPPG" => "Indicador de preferencia (desactiv.)","EXVER" => "Indicador de exportaci�n (desactiv.)","LGPBE" => "Ubicaci�n","KLABS" => "Stock en consignaci�n de libre utilizaci�n","KINSM" => "Stock de consignaci�n en control de calidad","KEINM" => "Stock consi no libre","KSPEM" => "Stock art�culos en consignaci�n bloqueado","DLINL" => "Fecha �ltimo recuento inventario stock libre utili","PRCTL" => "Centro de beneficio","ERSDA" => "Fecha de creaci�n","VKLAB" => "Valor de stocks de un material de valor al precio ","VKUML" => "Valor de venta en el traslado (de almac�n a almac�","LWMKB" => "�rea de picking para lean WM","MDRUE" => "El reg.MARDH p.per.ante-anterior del per.MARD ya e","MDJIN" => "Ejercicio del indicador de inventario actual",
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
