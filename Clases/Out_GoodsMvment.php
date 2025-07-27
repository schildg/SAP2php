<?php
include_once('DATA_CONF.php');
class Out_GoodsMvment extends SuperClase{
	function Out_GoodsMvment() {
		$this->CLASE_OBJETO='Out_GoodsMvment';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","AUFNR" => "numero de orden de fabricacion ","MATNR" => "numero de material ","TEXT_MSEG_MATNR" => "descripcion del material ","WERKS" => "Centro ","CHARG" => "Lote/Batch ","LGORT" => "Almacen ","BWART" => "Clase de movimiento ","MJAHR" => "Periodo contable del documento ","MBLNR" => "Numero de docuemnto de movimiento de mercancias ","MENGE" => "Cantidad que se movio/consumio ","MEINS" => "Unidad de medida ","EXIDV" => "Hand Unit SAP ","VENUM" => "numero interno de HU ",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vBWART,$vMJAHR,$vMBLNR) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"BWART ='$vBWART' and MJAHR='$vMJAHR' and MBLNR='$vMBLNR'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	function save(){
		switch ($this->BWART) {
			case '102':$this->MENGE=$this->MENGE*-1;break;
			case '262':$this->MENGE=$this->MENGE*-1;break;
		}						
		parent :: save();
	}
	
	
};
?>
