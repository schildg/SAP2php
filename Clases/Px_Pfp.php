<?php
include_once('DATA_CONF.php');
class Px_Pfp extends SuperClase{
	function Px_Pfp() {
		$this->CLASE_OBJETO='Px_Pfp';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","pend_lq" => "Pendiente?","ftur_lq" => "Fecha del Turno","htur_lq" => "Hora del turno","orde_lq" => "Orden","esta_lq" => "Estado","esta_lqt" => "esta_lqt","cmov_lq" => "Codigo","nmov_lq" => "Numero de Movimiento","tipo_lq" => "Tipo de Planificacion","tipo_lqt" => "tipo_lqt","erro_lq" => "Codigo de error","erro_lqt" => "erro_lqt","errn_lq" => "Numero de error","opem_lq" => "Opcion de embolsado","opem_lqt" => "opem_lqt","pemb_lq" => "Programa de Embolsado","tlod_lq" => "Tipo de Lote Destino","tlod_lqt" => "tlod_lqt","fech_lq" => "Fecha de Alta","form_lq" => "Formula","lotc_lq" => "Codigo de Lote","lotc_lqt" => "lotc_lqt","lotn_lq" => "Numero de lote","cdis_lq" => "Codigo de Dispositivo","cdis_lqt" => "cdis_lqt","ndis_lq" => "Numero de Dispositivo","cdid_lq" => "Codigo de Dispositivo final","cdid_lqt" => "cdid_lqt","ndid_lq" => "Numero de dispositivo final","cdoc_lq" => "Codigo documento de stock","ndoc_lq" => "Numero de documento de stock","proe_lq" => "Producto            (Envasado)","mare_lq" => "Marca               (Envasado)","enve_lq" => "Envase              (Envasado)","cene_lq" => "Cantidad            (Envasado)","cane_lq" => "Cantidad de Envases","cemb_lq" => "Cantidad embolsada","cant_lq" => "Cantidad","cori_lq" => "Cantidad original","prod_lq" => "Producto            (Fabricado)","marc_lq" => "Marca               (Fabricada)","enva_lq" => "Envase              (Fabricado)","cenv_lq" => "Cantidad del Envase (Fabricado)","cfor_lq" => "Codigo de formula","nfor_lq" => "Numero de formula","fetu_lq" => "Fecha estimada de turno","hetu_lq" => "Hora estimada de turno","fefi_lq" => "Fecha Fija del turno","hefi_lq" => "Hora fija del turno","nuca_lq" => "Campo del Error","cdo1_lq" => "Codigo Relacionado 1","ndo1_lq" => "Numero Relacionado 1","hold_lq" => "HOLD","hold_lqt" => "hold_lqt","toke_lq" => "Lo tiene","sect_lq" => "Sector de Agregado Manual","sect_lqt" => "sect_lqt","caru_lq" => "Cantidad a reusar de sobrante","crem_lq" => "Cantidad real embolsada","caco_lq" => "Cantidad a Completar","repl_lq" => "Responsable de Planta","taru_lq" => "Tipo de Sobrante","taru_lqt" => "taru_lqt","line_lq" => "Linea de Fabricacion","line_lqt" => "line_lqt","depo_lq" => "Deposito","aufa_lq" => "Autorizacion de Fabricacion","fill_lq" => "LIBRE PARA USO FUTURO",
                     );
        return $Campo[$campo];
	}
};
?>
