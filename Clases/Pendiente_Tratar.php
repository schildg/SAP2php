<?php
include_once('DATA_CONF.php');
class Pendiente_Tratar extends SuperClase{
	function Pendiente_Tratar() {
		$this->CLASE_OBJETO='Pendiente_Tratar';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","objeto" => "objeto","id_objeto" => "id_objeto","estado" => "estado","codigo" => "codigo","numero" => "numero","numero_sap" => "numero sap",
                     );
        return $Campo[$campo];
	}
	function todos($vobjeto,$vestado) {
		$rela = MyActiveRecord :: FindALL($this->CLASE_OBJETO,"objeto = '$vobjeto' AND estado ='$vestado' ");
		if (!$rela){
			return false;
		}else{
			return $rela;
		};

		
	}
	function todosCSM($vobjeto,$vestado) {
		$rela = MyActiveRecord :: FindALL($this->CLASE_OBJETO,"objeto = '$vobjeto' AND estado ='$vestado' ");
		if (!$rela){
			return false;
		}else{
			return $rela;
		};
	}

	function todosCONoTAM($vobjeto) {
		$rela = MyActiveRecord :: FindALL($this->CLASE_OBJETO,"objeto = '$vobjeto' AND (estado ='CON' OR estado='TAM')");
		if (!$rela){
			return false;
		}else{
			return $rela;
		};
		
	}
	
	
};
?>
