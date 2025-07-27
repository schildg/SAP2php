<?php
include_once('DATA_CONF.php');
class St_Lot extends SuperClase{
	function St_Lot() {
		$this->CLASE_OBJETO='St_Lot';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","prod_sl" => "CODIGO DE PRODUCTO","marc_sl" => "MARCA DEL LOTE","enva_sl" => "TIPO DE ENVASE","cenv_sl" => "CANTIDAD DE ENVASE","tipo_sl" => "CLASIFICACION 0 Termin  1-6 pendiente","esta_sl" => "ESTADO: CON EXISTENCIA SI/NO","fech_sl" => "FECHA DE CREACION DEL LOTE","lotc_sl" => "CODIGO DE LOTE","lotc_slt" => "lotc_slt","lotn_sl" => "NUMERO DE LOTE","esti_sl" => "COSTO ESTIMADO UNITARIO","defi_sl" => "COSTO DEFINITIVO UNITARIO","prec_sl" => "COSTO COMERCIAL UNITARIO","prio_sl" => "PRIORIDAD DEL LOTE","obse_sl" => "OBSERVACIONES DEL LOTE","desp_sl" => "NUMERO DE DESPACHO","desl_sl" => "CODIGO DE NUMERO DE DESPACHO","emay_sl" => "ENVASE MAYOR","cmay_sl" => "CANTIDAD DE ENVASES EN EL ENVASE MAYOR","crea_sl" => "Codigo Lote Real","nrea_sl" => "Numero de Lote Real","desn_sl" => "Numero de Despacho","dola_sl" => "COTIZACION DEL DOLAR","tcfi_sl" => "TIPO DE CAMBIO FIJO","otav_sl" => "Obs Tecnicas para Vtas","dens_sl" => "Densidad por litros","fveo_sl" => "Fecha de vencimiento original","rere_sl" => "Reetiquetar para revalidacion","orig_sl" => "PAIS DE ORIGEN DEL LOTE","pote_sl" => "POTENCIA DEL PRODUCTO","habi_sl" => "HABILITACION","emen_sl" => "ENVASE MENOR","cmen_sl" => "CANTIDAD DEL ENVASE","innu_sl" => "EMPRESA","cdoc_sl" => "Codigo de Referencia","ndoc_sl" => "Numero de Referencia","toke_sl" => "Lo tiene","sect_sl" => "Motivo de Origen","sect_slt" => "sect_slt","cert_sl" => "Lleva Certificado","rloc_sl" => "Codigo Lote Relacionado","rlon_sl" => "Numero Lote Relacionado","part_sl" => "Partida","fven_sl" => "Fecha de Vencimiento","tcad_sl" => "Total de costos adicionales del lote","conm_sl" => "Condicion de Mercaderia","conm_slt" => "conm_slt","tilo_sl" => "Tipo de lote","tilo_slt" => "tilo_slt","cosf_sl" => "Costo Financiero","cete_sl" => "Codigo de ET","nete_sl" => "Numero de ET","menc_sl" => "Mercaderia No Conforme","lvin_sl" => "Lleva Vencimiento Interno?","lvin_slt" => "lvin_slt","nsap_sl" => "Numero SAP","fill_sl" => "VACIO",
                     );
        return $Campo[$campo];
	}
	function buscarLote($vcmov,$vnmov) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"lotc_sl = '$vcmov' AND lotn_sl = '$vnmov'");
		if (!$rela){
			return false;
		}else{
			return $rela;
		}
	}
	
};

?>
