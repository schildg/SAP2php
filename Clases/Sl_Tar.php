<?php
include_once('DATA_CONF.php');
include_once('Ns_Rel.php');
include_once('St_Lot.php');
include_once('Sl_Utr.php');
class Sl_Tar extends SuperClase{
	function Sl_Tar() {
		$this->CLASE_OBJETO='Sl_Tar';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","cdoc_lt" => "Codigo de Documento Relacionado","ndoc_lt" => "Numero de Documento Relacionado","item_lt" => "Renglon del Documento","esta_lt" => "Estado del Documento","esta_ltt" => "esta_ltt","fcre_lt" => "Fecha de Creacion","hcre_lt" => "Hora de Creacion","cmov_lt" => "Codigo de Movimiento","nmov_lt" => "Numero de Movimiento","dior_lt" => "Direccion de Origen","utor_lt" => "Unidad de Transporte Origen","cnor_lt" => "Contenedor Origen","difi_lt" => "Direccion Final","utfi_lt" => "Unidad de Transporte Final","cnfi_lt" => "Contenedor Final","cant_lt" => "Cantidad","pers_lt" => "Encargado de la Tarea","ntar_lt" => "Numero de Tarea Relacionada","tipo_lt" => "Tipo de Tarea","tipo_ltt" => "tipo_ltt","utar_lt" => "Unidad de Tarea Asignada","prio_lt" => "Prioridad de Ejecucion","prio_ltt" => "prio_ltt","fasi_lt" => "Fecha de Asignacion","hasi_lt" => "Hora de Asignacion","face_lt" => "Fecha de Aceptacion","hace_lt" => "Hora de Aceptacion","ffin_lt" => "Fecha de Finalizacion","hfin_lt" => "Hora de Finalizacion","auto_lt" => "Autorizacion","nues_lt" => "Nuevo estado","nues_ltt" => "nues_ltt","itom_lt" => "Submotivo de la tarea","itom_ltt" => "itom_ltt","erco_lt" => "Ajuste PRX?","depo_lt" => "Deposito origen","diin_lt" => "Direccion intermedia","can1_lt" => "Cantidad 1","per1_lt" => "Persona","toma_lt" => "Tomada","toma_ltt" => "toma_ltt","econ_lt" => "Error de control","econ_ltt" => "econ_ltt","equi_lt" => "Equipo de RF","pees_lt" => "Ultima persona que cambio el listado","cuar_lt" => "Crear la cuarentena uso Reservado?","ipsa_lt" => "Identificador de pallet de salida","ppco_lt" => "Persona que realizo el primero control","psco_lt" => "Persona que realizo el segundo control","fill_lt" => "LIBRE PARA USO FUTURO",
                     );
        return $Campo[$campo];
	}
	function buscarTareas($vcmov,$vnmov) {
		$rela = MyActiveRecord :: FindAll($this->CLASE_OBJETO,"cdoc_lt = '$vcmov' AND ndoc_lt = '$vnmov' AND tipo_lt <> '001'","cant_lt ASC");
		if (!$rela){
			return false;
		}else{
			return $rela;
		};
	}
	function buscarTareasParticionadas($vcmov,$vnmov) {
		$rela = MyActiveRecord :: FindAll($this->CLASE_OBJETO,"cdoc_lt = '$vcmov' AND ndoc_lt = '$vnmov' AND tipo_lt <> '001' and declarado_en_sap='Particionada'","cant_lt ASC");
		if (!$rela){
			return false;
		}else{
			return $rela;
		};
	}	
	
	function tareasDeEntrada($vcmov,$vnmov) {
		$rela = MyActiveRecord :: FindAll($this->CLASE_OBJETO,"cdoc_lt = '$vcmov' AND ndoc_lt = '$vnmov' AND tipo_lt = '001'");
		if (!$rela){
			return false;
		}else{
			return $rela;
		};
	}	
	function nroUtSap() {
		$rel = new Ns_Rel();
		return $rel->buscoUt("UT",$this->utor_lt);
	}
	function nroLoteSap() {
		$rel = new Ns_Rel();
		$ut  = new Sl_Utr();
		$ut  = MyActiveRecord :: FindFirst("Sl_Utr","cmov_lu = 'UT' AND nmov_lu = $this->utor_lt");
		return $rel->buscoLote($ut->lotc_lu,$ut->lotn_lu);
	}
	function nroMaterialSap() {
		$rel = new Ns_Rel();
		$lot = new St_Lot();
		$ut  = new Sl_Utr();
		//echo "nroMaterialSap.php --> sl_utr $this->utor_lt \r\n";
		$ut  = MyActiveRecord :: FindFirst("Sl_Utr","cmov_lu = 'UT' AND nmov_lu = '$this->utor_lt'");
		//echo "nroMaterialSap.php --> st_lot $ut->lotc_lu $ut->lotn_lu \r\n";
		$lot = MyActiveRecord :: FindFirst("St_Lot","lotc_sl = '$ut->lotc_lu' AND lotn_sl = '$ut->lotn_lu'");
		//echo "nroMaterialSap.php --> buscoArticulo --> $lot->prod_sl $lot->marc_sl $lot->enva_sl $lot->cenv_sl \r\n";
		return $rel->buscoArticulo($lot->prod_sl,$lot->marc_sl,$lot->enva_sl,$lot->cenv_sl);
	}
	function hay_error_de_datos() {
		if ($this->nroMaterialSap()){
			if ($this->nroLoteSap()){
				if ($this->nroUtSap()){
					return false;
				}else{
					return true;
				}				
			}else{
				return true;
			}			
		}else{
			return true;
		}
	}
	
};
?>
