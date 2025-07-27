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
		$Campo=array("id" => "id","AUFNR" => "Número de orden","RSPOS" => "Número de posición de reserva/necesidades secundar","MATNR" => "Número de material","WERKS" => "Centro","CHARG" => "Número de lote","LGORT" => "Almacén","SOBKZ" => "Indicador de stock especial","VORNR" => "Número de operación","MENGE" => "Cantidad","MEINS" => "Unidad de medida base","ERFMG" => "Cantidad en unidad de medida de entrada","ERFME" => "Unidad de medida de entrada","VHILM" => "Material de embalaje","EXBNR" => "Nº puesta a disposición externo p.identificación m","EXIDV" => "Identificación externa de la unidad de manipulació","EXIDV_OB" => "Identif.unidad manipulación, en la cual se efectúa","EXPLZ" => "Ubicación de picking externa para identificación d","ERNAM" => "Nombre del responsable que ha añadido el objeto","ERDAT" => "Fecha de creación del registro","ERZET" => "Hora registrada","TWFLG" => "Indicador SM parc.permitido","BERTS" => "Status de puesta a disposición",
                     );
        return $Campo[$campo];
	}
};
?>
