<?php
include_once('DATA_CONF.php');
class Sf_Dic extends SuperClase{
	function Sf_Dic() {
		$this->CLASE_OBJETO='Sf_Dic';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","letr_di" => "LETRA PERSONAL DEL REGISTRO","line_di" => "LINEA DE ORDEN EN EL TEXTO .reg","nomb_di" => "NOMBRE LOGICO DE LA VARIABLE - CAMPO","nive_di" => "NIVEL QUE TIENE DENTRO DEL REGISTRO","sign_di" => "CAMPO CON SIGNO O SIN SIGNO","tipo_di" => "TIPO DE DATO","long_di" => "LONGITUD DEL CAMPO (SIN DECIMALES)","deci_di" => "CANTIDAD DE DIGITOS DECIMALES SI EXISTEN","clas_di" => "CLASIFICACION CAMPO/CLAVE/CLAVEPRIN/TABL","comp_di" => "TIPO DE DATO COMPUTACIONAL SI/NO COMP-3","occu_di" => "CANTIDAD DE OCURRENCIAS (OCCURS 99 TIMES","indi_di" => "CANTIDAD DE SUBINDICES DEL CAMPO ACTUAL","desc_di" => "DESCRIPCION DEL CAMPO","cond_di" => "CONDICION GENERAL PARA USAR EL CAMPO","crel_di" => "CONDICION PARA RELACIONAR OTROS CAMPOS","then_di" => "CAMPO RELACIONADO SI CUMPLE CONDICION IF","else_di" => "CAMPO RELAC. SI NO SE CUMPLE CONDIC IF","acce_di" => "CARGA EL HELP PARA EL ACCEPT DE LOS ENT","vocc_di" => "VARABLES DE OCCURS","nove_di" => "CONDICION PARA LAS NOVEDADES","list_di" => "Sacar del listador?","geta_di" => "Codigo especial","deau_di" => "DESCRIPCION PARA AUTORIZACION","repe_di" => "ESTE CAMPO REQUIERE AUTORIZACION ?","dwho_di" => "DATOS PARA DATAWHARE HOUSE?","nuno_di" => "Numero para novedad","cfun_di" => "Codigo de funcion","nfun_di" => "Numero de funcion","saln_di" => "Codigo de salida numerica","salx_di" => "Codigo de Salida Caracter","fill_di" => "LIBRE PARA USO FUTURO",
                     );
        return $Campo[$campo];
	}
};
?>
