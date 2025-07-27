<?php
include_once('DATA_CONF.php');
class Sf_Arc extends SuperClase{
	function Sf_Arc() {
		$this->CLASE_OBJETO='Sf_Arc';
	}
	function leyenda() {
		return $this->id." - ".$this->nreg_sf." - ".$this->desc_sf;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","nreg_sf" => "NOMBRE DEL REGISTRO","letr_sf" => "LETRAS DEL REGISTRO","nume_sf" => "NUMERO DE ARCHIVO","nfa1_sf" => "NOMBRE FISICO ARCHIVO UNO","nfa2_sf" => "NOMBRE FISICO DEL ARCHIVO DOS","nfa3_sf" => "NOMBRE FISICO DEL ARCHIVO TRES","nfa4_sf" => "NOMBRE FISICO DEL ARCHIVO CUATRO","nlar_sf" => "NONBRE LOGICO DEL ARCHIVO","desc_sf" => "DESCRIPCION DEL ARCHIVO","obse_sf" => "LLEVA OBSERVACIONES?","hist_sf" => "LLEVA HISTORIA?","nove_sf" => "LLEVA NOVEDADES?","tipo_sf" => "TIPO DE ARCHIVO","habi_sf" => "HABILITACION","cmo1_sf" => "CODIGO 1","cmo2_sf" => "CODIGO 2","cmo3_sf" => "CODIGO 3","nmo1_sf" => "NUMERO 1","nmo2_sf" => "NUMERO 2","nmo3_sf" => "NUMERO 3","nmo4_sf" => "NUMERO 4","des1_sf" => "DESCRIPCION DEL ARCHIVO FISICO 1","des2_sf" => "DESCRIPCION DEL ARCHIVO FISICO 2","des3_sf" => "DESCRIPCION DEL ARCHIVO FISICO 3","des4_sf" => "DESCRIPCION DEL ARCHIVO FISICO 4","list_sf" => "CAMPO PARA MOSTRAR EN EL LISTADOR","cabe_sf" => "REGISTRO CABECERA (si es una tabla)","gene_sf" => "SE GENERA ?","cnts_sf" => "CONTROLAR LA SERIE?","nodw_sf" => "Generar novedades en DW?","fill_sf" => "VACIO",
                     );
        return $Campo[$campo];
	}
};
?>
