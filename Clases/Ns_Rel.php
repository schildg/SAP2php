<?php
include_once('DATA_CONF.php');
class Ns_Rel extends SuperClase{
	function Ns_Rel() {
		$this->CLASE_OBJETO='Ns_Rel';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","tipo_ns" => "Tipo de Relacion","cdoc_ns" => "Codigo Documento Relacionado","ndoc_ns" => "Numero Documento Relacionado","item_ns" => "Item Documento Relacionado","site_ns" => "Sub Item Documento Relacionado","cmov_ns" => "Codigo de Documento","nmov_ns" => "Numero de Documento","tip1_ns" => "Tipo de Relacion","prod_ns" => "Producto","marc_ns" => "Marca","enva_ns" => "Envases","cenv_ns" => "Cantidad del Envase","cmo1_ns" => "Codigo de Movimiento","nmo1_ns" => "Numero de Movimiento","tip2_ns" => "Tipo de Relacion","csap_ns" => "Codigo SAP","nsap_ns" => "Numero de Documento SAP","cmo2_ns" => "Codigo de Movimiento","nmo2_ns" => "Numero de Movimiento","fill_ns" => "FILL",
                     );
        return $Campo[$campo];
	}
	function buscoPF($vcmov,$vnmov) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"cdoc_ns = '$vcmov' AND ndoc_ns = '$vnmov' AND tipo_ns = 5" );
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return str_pad((int) $rela->nsap_ns,12,"0",STR_PAD_LEFT);
		};
	}
	function buscoLote($vcmov,$vnmov) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"cdoc_ns = '$vcmov' AND ndoc_ns = '$vnmov' AND tipo_ns = 3" );
		if (!$rela){
			return false;
		}else{
			if(is_numeric($rela->nsap_ns)){
				return str_pad((int) $rela->nsap_ns,10,"0",STR_PAD_LEFT);
			}else{
				return $rela->nsap_ns;
			}
		};
	}
	function buscoUt($vcmov,$vnmov) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"cdoc_ns = '$vcmov' AND ndoc_ns = '$vnmov' AND tipo_ns = 4" );
		if (!$rela){
			return false;
		}else{
			if(strlen($rela->nsap_ns)>7){
				return str_pad((int) $rela->nsap_ns,20,"0",STR_PAD_LEFT);
			}else{
				return $rela->nsap_ns;
			}
		};
	}
	function buscoArticulo($vprod,$vmarc,$venva,$vcenv) {
		echo $vprod."-".$vmarc."-".$venva."-".$vcenv."\r\n";
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"tipo_ns = '001' AND prod_ns = $vprod AND marc_ns = '$vmarc' AND enva_ns = '$venva' AND cenv_ns = $vcenv" );
		if (!$rela){
			return false;
		}else{
			echo str_pad((int) $rela->nsap_ns,18,"0",STR_PAD_LEFT);
			return str_pad((int) $rela->nsap_ns,18,"0",STR_PAD_LEFT);
		};
	}
	function existe($clase,$nro) {
		switch ($clase) {
			case "MATERIAL":
				$numero = (int) $nro;
				$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"(tipo_ns = '001' or tipo_ns = '008' ) AND nsap_ns = '$numero'" );
				break;
			case "FORMULA":
				$numero = ltrim($nro,"0");
				$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"tipo_ns = '007' AND nsap_ns = '$numero'" );
				break;
		}
		if (!$rela){
			return false;
		}else{
			return true;
		};
	}
	
};
?>
