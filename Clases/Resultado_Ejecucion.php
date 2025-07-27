<?php
include_once('DATA_CONF.php');
class Resultado_Ejecucion extends SuperClase{
	function Resultado_Ejecucion() {
		$this->CLASE_OBJETO='Resultado_Ejecucion';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","RFC" => "RFC","id_objeto_sap" => "id_objeto_sap","TYPE" => "Tipo mensaje: S Success, E Error, W Warning, I Inf","ID_SAP" => "Clase de mensajes","NUMBER" => "Número de mensaje","MESSAGE" => "Texto de mensaje","LOG_NO" => "Log de aplicación: Número de log","LOG_MSG_NO" => "Log aplicación: Número consecutivo interno de mens","MESSAGE_V1" => "Variable de mensaje","MESSAGE_V2" => "Variable de mensaje","MESSAGE_V3" => "Variable de mensaje","MESSAGE_V4" => "Variable de mensaje","PARAMETER" => "Parámetro","FIELD" => "Campo en parámetro","SYSTEM" => "Sistema (lógico) del que procede el mensaje",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vRFC,$vId_Objeto) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"RFC = '$vRFC' AND id_objeto_sap = '$vId_Objeto'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	
};
?>
