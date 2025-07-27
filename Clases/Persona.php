<?php
include_once('DATA_CONF.php');
class Persona extends SuperClase {
	function Persona() {
		$this->CLASE_OBJETO='Persona';
	}
	function leyenda() {
		return $this->id." - ".$this->Apellido.", ".$this->Nombre;
	}
	function nombre() {
		return $this->Apellido.", ".$this->Nombre;
	}
	function ordenarPersonas($alumnos) {	
		$pers=array();$i=0;
		include_once ("Persona.php");
		$persona=new Persona();
		foreach ($alumnos as $alu) {
			$persona=$persona->buscar($alu->persona_id);
			$persona->cursa=$alu;
			$pers[$i]=$persona;
			$i++;
		}
		
		$aux = new Persona;
	    $N = count($pers);
	            for($i=0;$i < $N;$i++)
                        for($j=1;$j<$N;$j++)
                                if(($pers[$j-1]->nombre()) > ($pers[$j]->nombre())){
                                                $aux = $pers[$j];
                                                $pers[$j] = $pers[$j-1];
                                                $pers[$j-1] = $aux;
                                        }
		return $pers;
		
	}
	function nombrepersona($id) {
		$pers=new Persona();
		$pers= $pers->buscar($id);
		return $pers->nombre();
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "Nombre" => "Nombre de la Persona",
                     "Apellido" => "Apellido de la Persona",
                     "fecha_nac" => "Fecha de Nacimiento",
                     "G_sanguineo" => "Grupo Sanguineo",
                     "Es_Alumno" => "Es Alumno",
                     "Es_Tutor" => "Es Tutor",
                     "Es_Docente" => "Es Docente",
                     "DNI" => "DNI",
                     "Sexo" => "Sexo",
                     "telefono" => "telefono"
                     );
        return $Campo[$campo];
	}
    function dniUnico($dni){
		$unico = MyActiveRecord :: FindFirst('Persona', "DNI = '$dni'");
		if($unico){
			return true;
		}else{
			return false;
		}
    }
	function save() {
		include_once ("Historia.php");
		if (empty ($this->Apellido))
			$this->add_error('Apellido', 'El Apellido no puede estar en blanco');
		if ($this->id ==0 and $this->dniUnico($this->DNI))
			$this->add_error('DNI', 'El numero de DNI ya se encuentra cargado');
		if (empty ($this->Nombre))
			$this->add_error('Nombre', 'El Nombre no puede estar en blanco');
		if (empty ($this->DNI))
			$this->add_error('DNI', 'El DNI no puede ser nulo');
		if( $this->get_errors() )
		{
			$_SESSION['errores']=$this->get_errors();
		}
		else{
			parent :: save();
		}
	}
}
?>
