<?php
include_once('DATA_CONF.php');
class Actualizacion_CRM extends SuperClase{
	function Actualizacion_CRM($obj=null) {
		$this->CLASE_OBJETO='Actualizacion_CRM';
		if ($obj !==null){
			$this->Objeto=$obj;
			$tabla= MyActiveRecord :: FindFirst('Actualizacion_CRM', "Objeto = '$obj'");
			if ($tabla){
				$columna= MyActiveRecord::Columns($this->CLASE_OBJETO);
				foreach ($columna as $k => $v) {
					$this->$k=$tabla->$k;
				}
			}			
		}
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","Objeto" => "Objeto - Tabla","Ultima_Actualizacion" => "Fecha de la Ultima Actualizacion exitosa",
                     );
        return $Campo[$campo];
	}
	function save(){
		if($this->Objeto!="Fecha_Compensacion"){
			$timestamp_hoy = mktime(0, 0, 0,  date("m"), date("d"), date("Y"));
			$this->Ultima_Actualizacion= date("Ymd",$timestamp_hoy);
		}
		parent :: save();
	}
	
	
	
};
?>
