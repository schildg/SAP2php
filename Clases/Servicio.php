<?php
include_once('DATA_CONF.php');
class Servicio extends SuperClase{
	var $alfabeto;
	
	function Servicio($nombre_de_servicio=null) {
		$this->CLASE_OBJETO='Servicio';
		if ($nombre_de_servicio !==null){
			$serv= MyActiveRecord :: FindFirst('Servicio', "nombre_servicio = '$nombre_de_servicio'");
			if ($serv){
				$columna= MyActiveRecord::Columns($this->CLASE_OBJETO);
				foreach ($columna as $k => $v) {
					$this->$k=$serv->$k;
				}
			}			
		}
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","nombre_servicio" => "Servicio","estado" => "Estado","subestado" => "SubEstado","secuencia" => "Nro Secuencia","paquete" => "Paquete","mensaje" => "Mensaje","pid" => "PID del proceso",
                     );
        return $Campo[$campo];
	}
	function start(){
		$this->pid = getmypid();
		$this->alfabeto = "start()";
		$this->mensaje = "";
		$this->paquete = "";
		if ($this->set_estado()){
            $comando="start /B \"$this->nombre_servicio\" ".PHP_EXE_PATH." -f ".$this->nombre_servicio.".php >".LOGS_PATH.$this->nombre_servicio."_Out-".date("Ymd_His").".txt";
//           echo $comando;
			pclose(popen($comando, "r"));
		}		
	}
	function trato_error(){
		if ($this->estado == "ERROR"){
			rename(PATH_NOVEDADES_ENTRADA."hayerror/".$this->paquete,PATH_NOVEDADES_ENTRADA.$this->paquete);			
			rename(PATH_NOVEDADES_ENTRADA."hayerror/".$this->paquete.".control",PATH_NOVEDADES_ENTRADA.$this->paquete.".control");
			$this->start();			
		}						
	}
	function trato_secue(){
		if ($this->estado == "SECUE"){
			if ($this->paquete){
				rename(PATH_NOVEDADES_ENTRADA."seque/".$this->paquete,PATH_NOVEDADES_ENTRADA.$this->paquete);			
				rename(PATH_NOVEDADES_ENTRADA."seque/".$this->paquete.".control",PATH_NOVEDADES_ENTRADA.$this->paquete.".control");
			}
			$this->start();			
		}						
	}
	function stop(){
		$this->alfabeto = "stop()";
		if($this->set_estado()){
			$this->pid = 0;
			$this->mensaje="";
			$this->subestado="";
			$this->save();
		}
	}
	function trato_paquete(){
		$sql_ok = true; 
		$sql = file_get_contents(PATH_NOVEDADES_ENTRADA.$this->paquete);       //obtengo el contenido del archivo en un string
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			
// Si no se quiere que de error las novedades, comentar las tres lineas siguientes			
    		$this->mensaje = "error en ejecucion de la consulta ".$paquete."\r\n".$e;
			$this->pongo_hayError();
			$sql_ok = false;
		}
		if ($sql_ok){
			if (!file_exists(PATH_NOVEDADES_ENTRADA_ACUMULA)){
				mkdir(PATH_NOVEDADES_ENTRADA_ACUMULA);
			}
			//rename(PATH_NOVEDADES_ENTRADA.$this->paquete,PATH_NOVEDADES_ENTRADA."acumula/".$this->paquete);			
			//rename(PATH_NOVEDADES_ENTRADA.$this->paquete.".control",PATH_NOVEDADES_ENTRADA."acumula/".$this->paquete.".control");
			rename(PATH_NOVEDADES_ENTRADA.$this->paquete,PATH_NOVEDADES_ENTRADA_ACUMULA.$this->paquete);			
			unlink(PATH_NOVEDADES_ENTRADA.$this->paquete.".control");			
			$this->incrementar_secuencia();
		}
	}
	function calcula_estado($msg_alfabeto=null) {
		$delta["impoAnita"]["RUNNING"]["start()"]="RUNNING";
		$delta["impoAnita"]["STOP"]["start()"]="RUNNING";
		$delta["impoAnita"]["ERROR"]["start()"]="RUNNING";
		$delta["impoAnita"]["SECUE"]["start()"]="RUNNING";
		$delta["impoAnita"]["RUNNING"]["stop()"]="STOP";
		$delta["impoAnita"]["STOP"]["stop()"]="STOP";
		$delta["impoAnita"]["ERROR"]["stop()"]="ERROR";
		$delta["impoAnita"]["SECUE"]["stop()"]="SECUE";
		$delta["impoAnita"]["RUNNING"]["pongo_secue()"]="SECUE";
		$delta["impoAnita"]["STOP"]["pongo_secue()"]="STOP";
		$delta["impoAnita"]["ERROR"]["pongo_secue()"]="ERROR";
		$delta["impoAnita"]["SECUE"]["pongo_secue()"]="SECUE";
		$delta["impoAnita"]["RUNNING"]["trato_secue()"]="RUNNING";
		$delta["impoAnita"]["STOP"]["trato_secue()"]="STOP";
		$delta["impoAnita"]["ERROR"]["trato_secue()"]="ERROR";
		$delta["impoAnita"]["SECUE"]["trato_secue()"]="RUNNING";
		$delta["impoAnita"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["impoAnita"]["STOP"]["pongo_hayError()"]="STOP";
		$delta["impoAnita"]["ERROR"]["pongo_hayError()"]="ERROR";
		$delta["impoAnita"]["SECUE"]["pongo_hayError()"]="SECUE";
		$delta["impoAnita"]["RUNNING"]["trato_error()"]="RUNNING";
		$delta["impoAnita"]["STOP"]["trato_error()"]="STOP";
		$delta["impoAnita"]["ERROR"]["trato_error()"]="RUNNING";
		$delta["impoAnita"]["SECUE"]["trato_error()"]="SECUE";
		
		$delta["comprimeAnita"]["RUNNING"]["start()"]="RUNNING";
		$delta["comprimeAnita"]["RUNNING"]["stop()"]="STOP";
		$delta["comprimeAnita"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["comprimeAnita"]["STOP"]["start()"]="RUNNING";
		$delta["comprimeAnita"]["STOP"]["stop()"]="STOP";
		$delta["comprimeAnita"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["comprimeAnita"]["ERROR"]["start()"]="RUNNING";
		$delta["comprimeAnita"]["ERROR"]["stop()"]="STOP";
		$delta["comprimeAnita"]["ERROR"]["pongo_hayError()"]="ERROR";
		
		$delta["impoSAP"]["RUNNING"]["start()"]="RUNNING";
		$delta["impoSAP"]["RUNNING"]["stop()"]="STOP";
		$delta["impoSAP"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["impoSAP"]["STOP"]["start()"]="RUNNING";
		$delta["impoSAP"]["STOP"]["stop()"]="STOP";
		$delta["impoSAP"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["impoSAP"]["ERROR"]["start()"]="RUNNING";
		$delta["impoSAP"]["ERROR"]["stop()"]="STOP";
		$delta["impoSAP"]["ERROR"]["pongo_hayError()"]="ERROR";
		
		$delta["ingresosASAP"]["RUNNING"]["start()"]="RUNNING";
		$delta["ingresosASAP"]["RUNNING"]["stop()"]="STOP";
		$delta["ingresosASAP"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["ingresosASAP"]["STOP"]["start()"]="RUNNING";
		$delta["ingresosASAP"]["STOP"]["stop()"]="STOP";
		$delta["ingresosASAP"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["ingresosASAP"]["ERROR"]["start()"]="RUNNING";
		$delta["ingresosASAP"]["ERROR"]["stop()"]="STOP";
		$delta["ingresosASAP"]["ERROR"]["pongo_hayError()"]="ERROR";

		$delta["consumosSAP"]["RUNNING"]["start()"]="RUNNING";
		$delta["consumosSAP"]["RUNNING"]["stop()"]="STOP";
		$delta["consumosSAP"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["consumosSAP"]["STOP"]["start()"]="RUNNING";
		$delta["consumosSAP"]["STOP"]["stop()"]="STOP";
		$delta["consumosSAP"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["consumosSAP"]["ERROR"]["start()"]="RUNNING";
		$delta["consumosSAP"]["ERROR"]["stop()"]="STOP";
		$delta["consumosSAP"]["ERROR"]["pongo_hayError()"]="ERROR";
		
		$delta["notificacionSAP"]["RUNNING"]["start()"]="RUNNING";
		$delta["notificacionSAP"]["RUNNING"]["stop()"]="STOP";
		$delta["notificacionSAP"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["notificacionSAP"]["STOP"]["start()"]="RUNNING";
		$delta["notificacionSAP"]["STOP"]["stop()"]="STOP";
		$delta["notificacionSAP"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["notificacionSAP"]["ERROR"]["start()"]="RUNNING";
		$delta["notificacionSAP"]["ERROR"]["stop()"]="STOP";
		$delta["notificacionSAP"]["ERROR"]["pongo_hayError()"]="ERROR";
		
		$delta["impoSAP2CRM"]["RUNNING"]["start()"]="RUNNING";
		$delta["impoSAP2CRM"]["RUNNING"]["stop()"]="STOP";
		$delta["impoSAP2CRM"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["impoSAP2CRM"]["STOP"]["start()"]="RUNNING";
		$delta["impoSAP2CRM"]["STOP"]["stop()"]="STOP";
		$delta["impoSAP2CRM"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["impoSAP2CRM"]["ERROR"]["start()"]="RUNNING";
		$delta["impoSAP2CRM"]["ERROR"]["stop()"]="STOP";
		$delta["impoSAP2CRM"]["ERROR"]["pongo_hayError()"]="ERROR";

		$delta["impo_cada10"]["RUNNING"]["start()"]="RUNNING";
		$delta["impo_cada10"]["RUNNING"]["stop()"]="STOP";
		$delta["impo_cada10"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["impo_cada10"]["STOP"]["start()"]="RUNNING";
		$delta["impo_cada10"]["STOP"]["stop()"]="STOP";
		$delta["impo_cada10"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["impo_cada10"]["ERROR"]["start()"]="RUNNING";
		$delta["impo_cada10"]["ERROR"]["stop()"]="STOP";
		$delta["impo_cada10"]["ERROR"]["pongo_hayError()"]="ERROR";

		$delta["impoMaestrosCRM"]["RUNNING"]["start()"]="RUNNING";
		$delta["impoMaestrosCRM"]["RUNNING"]["stop()"]="STOP";
		$delta["impoMaestrosCRM"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["impoMaestrosCRM"]["STOP"]["start()"]="RUNNING";
		$delta["impoMaestrosCRM"]["STOP"]["stop()"]="STOP";
		$delta["impoMaestrosCRM"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["impoMaestrosCRM"]["ERROR"]["start()"]="RUNNING";
		$delta["impoMaestrosCRM"]["ERROR"]["stop()"]="STOP";
		$delta["impoMaestrosCRM"]["ERROR"]["pongo_hayError()"]="ERROR";
		
		$delta["impoDocCRM"]["RUNNING"]["start()"]="RUNNING";
		$delta["impoDocCRM"]["RUNNING"]["stop()"]="STOP";
		$delta["impoDocCRM"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["impoDocCRM"]["STOP"]["start()"]="RUNNING";
		$delta["impoDocCRM"]["STOP"]["stop()"]="STOP";
		$delta["impoDocCRM"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["impoDocCRM"]["ERROR"]["start()"]="RUNNING";
		$delta["impoDocCRM"]["ERROR"]["stop()"]="STOP";
		$delta["impoDocCRM"]["ERROR"]["pongo_hayError()"]="ERROR";

		$delta["impo_x_fecha_sap"]["RUNNING"]["start()"]="RUNNING";
		$delta["impo_x_fecha_sap"]["RUNNING"]["stop()"]="STOP";
		$delta["impo_x_fecha_sap"]["RUNNING"]["pongo_hayError()"]="ERROR";
		$delta["impo_x_fecha_sap"]["STOP"]["start()"]="RUNNING";
		$delta["impo_x_fecha_sap"]["STOP"]["stop()"]="STOP";
		$delta["impo_x_fecha_sap"]["STOP"]["pongo_hayError()"]="ERROR";
		$delta["impo_x_fecha_sap"]["ERROR"]["start()"]="RUNNING";
		$delta["impo_x_fecha_sap"]["ERROR"]["stop()"]="STOP";
		$delta["impo_x_fecha_sap"]["ERROR"]["pongo_hayError()"]="ERROR";
		
		if ($msg_alfabeto==null){
			$msg_alfabeto=$this->alfabeto;
		}		
		//echo " servicio: ".$this->nombre_servicio."> estado: ".$this->estado."> alfabeto: ".$msg_alfabeto." RESULTADO: ".$delta[$this->nombre_servicio][$this->estado][$this->alfabeto];		
		return $delta[$this->nombre_servicio][$this->estado][$msg_alfabeto];
	}
	function get_alfabeto() {
		$prox=array();
		$conjunto_alfabeto=array('stop()','start()','trato_error()','trato_secue()');
		foreach ($conjunto_alfabeto as $alf){
			if($this->calcula_estado($alf)!=$this->estado && $this->calcula_estado($alf)!=""){
				array_push($prox, $alf);
			}
		}
		return $prox;
	}
	function set_estado() {
		if (!file_exists(FLAGS_PATH)){
			mkdir(FLAGS_PATH);
		}
		if (!file_exists(LOGS_PATH)){
			mkdir(LOGS_PATH);
		}
		if ($this->calcula_estado()!=$this->estado){
			if (file_exists(FLAGS_PATH.$this->nombre_servicio.".".$this->estado)){
				unlink(FLAGS_PATH.$this->nombre_servicio.".".$this->estado);
			}
			$this->estado = $this->calcula_estado();
			$this->save();
			$file_status_out= fopen(FLAGS_PATH.$this->nombre_servicio.".".$this->estado, "w");
 			fclose ($file_status_out);			
			return true;
		}else{
			return false;
		}		
	}
	function get_secuencia() {
		return $this->secuencia;
	}
	function is_running() {
		return file_exists(FLAGS_PATH.$this->nombre_servicio.".RUNNING");
	}
	function set_subestado($status) {
		$this->subestado=$status;
		$this->save();
	}
	function incrementar_secuencia() {
		if ($this->secuencia >= 999999){
			$this->secuencia =0;
		}else{
			$this->secuencia = $this->secuencia + 1; 
		}
		$nro = $this->secuencia;
		$this->save();
		return $nro;
	}
	function tiene_punto_control() {
		return file_exists(PATH_NOVEDADES_ENTRADA.$this->paquete.".control");
	}
	function pongo_hayError($mensaje_error=null){
		$this->alfabeto = "pongo_hayError()";
		if ($this->set_estado()){
			switch ($this->nombre_servicio) {
				case "impoAnita":
					if (!file_exists(PATH_NOVEDADES_ENTRADA."hayerror/")){
						mkdir(PATH_NOVEDADES_ENTRADA."hayerror/");
					}
					rename(PATH_NOVEDADES_ENTRADA.$this->paquete,PATH_NOVEDADES_ENTRADA."hayerror/".$this->paquete);			
					rename(PATH_NOVEDADES_ENTRADA.$this->paquete.".control",PATH_NOVEDADES_ENTRADA."hayerror/".$this->paquete.".control");			
					break;
				case "impoSAP":
					$this->mensaje = $mensaje_error;
					break;
				case "impoSAP2CRM":
					$this->mensaje = $mensaje_error;
					break;
				case "impo_cada10":
					$this->mensaje = $mensaje_error;
					break;
				case "impoDocCRM":
					$this->mensaje = $mensaje_error;
					break;
				case "ingresosASAP":
					$this->mensaje = $mensaje_error;
					break;
				case "consumosSAP":
					$this->mensaje = $mensaje_error;
					break;
				case "notificacionSAP":
					$this->mensaje = $mensaje_error;
					break;
	
				default:
					$e = $mensaje_error;
					if(isset($e[type])){
						$this->mensaje = $e[type]." ".$e[message]." ".$e[file]." ".$e[line];
					}else{
						$this->mensaje = $mensaje_error;
					}		
				break;
			}
			$this->save();			
			
		}
	}
	function pongo_secue(){
		$this->alfabeto = "pongo_secue()";
		if ($this->set_estado()){
			if (!file_exists(PATH_NOVEDADES_ENTRADA."seque/")){
				mkdir(PATH_NOVEDADES_ENTRADA."seque/");
			}
			if ($this->paquete){
				rename(PATH_NOVEDADES_ENTRADA.$this->paquete,PATH_NOVEDADES_ENTRADA."seque/".$this->paquete);			
				rename(PATH_NOVEDADES_ENTRADA.$this->paquete.".control",PATH_NOVEDADES_ENTRADA."seque/".$this->paquete.".control");
			}
			$this->paquete = "";			
			$this->mensaje = "";		
			$this->save();	
		}
	}
		
};
?>
