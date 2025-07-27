<?php
include_once('DATA_CONF.php');
class St_Rld extends SuperClase{
	function St_Rld() {
		$this->CLASE_OBJETO='St_Rld';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","cmov_sr" => "CODIGO DE DOCUMENTO","nmov_sr" => "NUMERO DE DOCUMENTO","item_sr" => "ITEM","pro1_sr" => "PRODUCTO","lotc_sr" => "CODIGO DE LOTE DE STOCK","lotn_sr" => "NUMERO DE LOTE DE STOCK","prod_sr" => "PRODUCTO","marc_sr" => "MARCA","enva_sr" => "ENVASE","cenv_sr" => "CANTIDAD DEL ENVASE","sign_sr" => "SIGNO","cant_sr" => "CANTIDAD","depo_sr" => "DEPOSITO","dep1_sr" => "DEPOSITO 1","moti_sr" => "Motivo","itom_sr" => "Submotivo","fill_sr" => "LIBRE PARA USO FUTURO",
                     );
        return $Campo[$campo];
	}
	function buscarREL($vcmov,$vnmov,$vsigno) {
		$rela = MyActiveRecord :: FindAll($this->CLASE_OBJETO,"cmov_sr = '$vcmov' AND nmov_sr = '$vnmov' AND sign_sr = '$vsigno'");
		if (!$rela){
			return false;
		}else{
			return $rela;
		};
	}	
};
?>
