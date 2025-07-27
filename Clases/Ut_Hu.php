<?php
include_once('DATA_CONF.php');
class Ut_Hu extends SuperClase{
	function Ut_Hu() {
		$this->CLASE_OBJETO='Ut_Hu';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","cmov_lu" => "Codigo de UT Anita","nmov_lu" => "Numero de UT Anita","AUFNR" => "Número de orden","EXIDV_OB" => "Identif.unidad manipulación, en la cual se efectúa","estado" => "Unidad de medida base",
                     );
        return $Campo[$campo];
	}
	function buscoUT($vcmov,$vnmov) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"cmov_lu = '$vcmov' AND nmov_lu = '$vnmov'" );
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
	}
	function buscoTarea($vtarea) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"tarea=$vtarea" );
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
	}
	
};
?>
