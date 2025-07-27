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
		$Campo=array("id" => "id","WERKS" => "Centro","LGORT" => "Almacén","LGOBE" => "Denominación de almacén","SPART" => "Sector","XLONG" => "Stocks negativos permitidos en almacén","XBUFX" => "Está permitido fijar stock teórico en almacén","DISKZ" => "Indicador de planificación de necesidades de almac","XBLGO" => "Autorización almacén activa durante movimientos me","XRESS" => "Almacén asignado a recurso (recurso de almacén)","XHUPF" => "Obligación unidad manipulación","PARLG" => "Almacén interlocutor en unidad de manipulación","VKORG" => "Organización de ventas","VTWEG" => "Canal de distribución","VSTEL" => "Pto.exped./depto.entrada mcía.","LIFNR" => "Número de cuenta del proveedor","KUNNR" => "Número de cuenta del cliente","MESBS" => "Sistema empresarial de MES","MESST" => "Clase de gestión stocks para almacén de producción","OIH_LICNO" => "Número de permiso para stock exento de impuestos","OIG_ITRFL" => "TD: Indicador en tránsito","OIB_TNKASSIGN" => "Gestión de silos: indicador de asignación de tanqu",
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
