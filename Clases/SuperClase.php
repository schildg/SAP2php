<?php
include_once('DATA_CONF.php');
class SuperClase extends MyActiveRecord {
	var $CLASE_OBJETO;
/*	function leyendaListado($objeto,$id) {
		$obj= MyActiveRecord :: Create($objeto);
		$obj= $obj->buscar($id);
		return $obj->leyenda();
	}
*/	
	function buscoIdForaneo($campo, $valor) {
		$obj1= MyActiveRecord::Create($this->CLASE_OBJETO);
		$obj2= MyActiveRecord::Create($obj1->esForaneo($campo));
		$tipo_dato = $obj2->GetType($this->CLASE_OBJETO,$campo);
		if ($tipo_dato == 'varbinary' ||$tipo_dato == 'varchar' ||$tipo_dato == 'char'){
		    $obj2= MyActiveRecord :: FindFirst($obj1->esForaneo($campo),$obj1->campoForaneo($campo)." = '".$valor."'" );
		} else{
		    $obj2= MyActiveRecord :: FindFirst($obj1->esForaneo($campo),$obj1->campoForaneo($campo)." = ".$valor );
		}
		return $obj2->id;
	}
	function leyendaDelIdListado($campo, $valor) {
		$obj1= MyActiveRecord::Create($this->CLASE_OBJETO);
		$obj2= MyActiveRecord::Create($obj1->esForaneo($campo));
		$tipo_dato = $obj2->GetType($this->CLASE_OBJETO,$campo);
		if ($tipo_dato == 'varbinary' ||$tipo_dato == 'varchar' ||$tipo_dato == 'char'){
		    $obj2= MyActiveRecord :: FindFirst($obj1->esForaneo($campo),$obj1->campoForaneo($campo)." = '".$valor."'" );
		} else{
		    $obj2= MyActiveRecord :: FindFirst($obj1->esForaneo($campo),$obj1->campoForaneo($campo)." = ".$valor );
		}
		return $obj2->leyenda();
	}
	
	function GET_campo($campo) {
		return $this->$campo;
	}
	function buscar($id) {
		$rela= MyActiveRecord :: FindFirst($this->CLASE_OBJETO, "id = '$id'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
	}
	function valoresForaneos() {
		$columna= MyActiveRecord::Columns($this->CLASE_OBJETO);
		$obj1= MyActiveRecord::Create($this->CLASE_OBJETO);
		foreach ($columna as $k => $v) {
			if ($k="establecimiento_id"){
				$this->establecimiento_id= $_SESSION['establecimiento'];
			}else{ 
				if($obj1->esForaneo($k)){
					$obj= MyActiveRecord::Create($obj1->esForaneo($k));
				    if(!$obj->FindById($obj1->esForaneo($k),$this->$k)){
				    	return true;
				    }
				}
			}
		}
		return false;
	}
	function relacionesForaneas() {
		$rela= MyActiveRecord :: Create('Diccionario');
		$relas= MyActiveRecord :: FindAll('Diccionario', "objeto_foraneo = '$this->CLASE_OBJETO'");
		foreach($relas as $rela){
			$obj= MyActiveRecord :: Create($rela->objeto);
			$obj=MyActiveRecord :: FindFirst($rela->objeto, "$rela->campo = '$this->id'");
			if ($obj){
				return true;
			}
		}
		return false;
	}
	function esForaneo($campo) {
		$rela= MyActiveRecord :: Create('Diccionario');
		$rela= MyActiveRecord :: FindFirst('Diccionario', "objeto = '$this->CLASE_OBJETO' and campo='$campo' and es_foraneo = 1");
		if ($rela->objeto_foraneo){
			return $rela->objeto_foraneo;
		}else{
			return false;
		};
	}
	function campoForaneo($campo) {
		$rela= MyActiveRecord :: Create('Diccionario');
		$rela= MyActiveRecord :: FindFirst('Diccionario', "objeto = '$this->CLASE_OBJETO' and campo='$campo' and es_foraneo = 1");
		if ($rela->campo_foraneo){
			return $rela->campo_foraneo;
		}else{
			return false;
		};
	}
	function formatear_nro_sap($objeto,$k) {
		if($objeto->GetType($objeto->CLASE_OBJETO,$k) === "decimal"){
			if(strpos($objeto->$k,"-")){
//				echo "antes   id:".$objeto->id." clase:".$objeto->CLASE_OBJETO." campo:".$k." valor:".$objeto->$k."\r\n";
				$objeto->$k=str_replace("-","",$objeto->$k);
				$objeto->$k="-".trim($objeto->$k);
//				echo "despues id:".$objeto->id." clase:".$objeto->CLASE_OBJETO." campo:".$k." valor:".$objeto->$k."\r\n";
			}
		}
		return $objeto->$k;
	}
	
	function buscarId($id) {
		return MyActiveRecord :: FindFirst($this->CLASE_OBJETO, "id = '$id'");
	}
    function concurrency(){
    	if ($this->id){
    		$obj=$this->buscarId($this->id);
    		if($obj->date_concurrency!=$this->date_concurrency){
    			return true;
    		}else{
    			return false;
    		}
    	}else{
    		return false;
    	}
    }
	function save() {
		include_once ("Historia.php");
		if ($this->concurrency())
			$this->add_error('date_concurrency', 'Debera recargar el registro dado que otra persona lo ha modificado');
		if ($this->valoresForaneos())
			$this->add_error('id', 'Se esta cargando una relacion con un valor externo que no Existe');	    	
		if( $this->get_errors() )
		{
			$_SESSION['errores']=$this->get_errors();
			echo $this->get_errors();
		}
		else{
			foreach ($this as $k=>$v){                          //solo se usa para tablas de SAP...sacar
				$this->$k=$this->formatear_nro_sap($this,$k);   //solo se usa para tablas de SAP...sacar
			}                                                   //solo se usa para tablas de SAP...sacar
			$old=MyActiveRecord :: FindById($this->CLASE_OBJETO, $this->id);
			if (!$this->id){
				$this->date_concurrency = $this->DbDateTime(time()-3600);
			}
			parent :: save();
			$new=$this;
			$historia=new Historia();
			$historia->generarHistoria($this->CLASE_OBJETO,$old,$new);
		}
	}
	function destroy() {
		if ($this->concurrency())
			$this->add_error('date_concurrency', 'Debera recargar el registro dado que otra persona lo ha modificado');
		if ($this->relacionesForaneas())
			$this->add_error('id', 'Este objeto tiene relaciones que lo vinculan, Borre primero todas las relaciones e intente nuevamente');
		if( $this->get_errors() )
		{
			$_SESSION['errores']=$this->get_errors();
		}
		else{
			include_once ("Historia.php");
			$historia=new Historia();
			$historia->borrarHistoria($this->CLASE_OBJETO,$this);
			return parent :: destroy();
		}
	}


};
?>
