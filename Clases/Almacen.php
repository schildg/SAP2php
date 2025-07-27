<?php
include_once('DATA_CONF.php');
class Almacen extends SuperClase{
	function Almacen() {
		$this->CLASE_OBJETO='Almacen';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","WERKS" => "Centro","LGORT" => "Almac�n","LGOBE" => "Denominaci�n de almac�n","SPART" => "Sector","XLONG" => "Stocks negativos permitidos en almac�n","XBUFX" => "Est� permitido fijar stock te�rico en almac�n","DISKZ" => "Indicador de planificaci�n de necesidades de almac","XBLGO" => "Autorizaci�n almac�n activa durante movimientos me","XRESS" => "Almac�n asignado a recurso (recurso de almac�n)","XHUPF" => "Obligaci�n unidad manipulaci�n","PARLG" => "Almac�n interlocutor en unidad de manipulaci�n","VKORG" => "Organizaci�n de ventas","VTWEG" => "Canal de distribuci�n","VSTEL" => "Pto.exped./depto.entrada mc�a.","LIFNR" => "N�mero de cuenta del proveedor","KUNNR" => "N�mero de cuenta del cliente","MESBS" => "Sistema empresarial de MES","MESST" => "Clase de gesti�n stocks para almac�n de producci�n","OIH_LICNO" => "N�mero de permiso para stock exento de impuestos","OIG_ITRFL" => "TD: Indicador en tr�nsito","OIB_TNKASSIGN" => "Gesti�n de silos: indicador de asignaci�n de tanqu",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vWERKS,$vLGORT) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"WERKS = '$vWERKS' AND LGORT = '$vLGORT'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	
};
?>
