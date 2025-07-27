<?php
include_once('DATA_CONF.php');
class Out_OrdFab_Consumo extends SuperClase{
	function Out_OrdFab_Consumo() {
		$this->CLASE_OBJETO='Out_OrdFab_Consumo';
	}
	function leyenda() {
		return $this->id;
	}
	function buscarExtendido($vTarea) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"Tarea = '$vTarea'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	
	function rotulo($campo) {
		$Campo=array("id" => "id","AUFNR" => "N�mero de orden","RSPOS" => "N�mero de posici�n de reserva/necesidades secundar","MATNR" => "N�mero de material","WERKS" => "Centro","CHARG" => "N�mero de lote","LGORT" => "Almac�n","SOBKZ" => "Indicador de stock especial","VORNR" => "N�mero de operaci�n","MENGE" => "Cantidad","MEINS" => "Unidad de medida base","ERFMG" => "Cantidad en unidad de medida de entrada","ERFME" => "Unidad de medida de entrada","VHILM" => "Material de embalaje","EXBNR" => "N� puesta a disposici�n externo p.identificaci�n m","EXIDV" => "Identificaci�n externa de la unidad de manipulaci�","EXIDV_OB" => "Identif.unidad manipulaci�n, en la cual se efect�a","EXPLZ" => "Ubicaci�n de picking externa para identificaci�n d","ERNAM" => "Nombre del responsable que ha a�adido el objeto","ERDAT" => "Fecha de creaci�n del registro","ERZET" => "Hora registrada","TWFLG" => "Indicador SM parc.permitido","BERTS" => "Status de puesta a disposici�n",
                     );
        return $Campo[$campo];
	}
};
?>
