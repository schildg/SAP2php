<?php
include_once('DATA_CONF.php');
class Sl_Utr extends SuperClase{
	function Sl_Utr() {
		$this->CLASE_OBJETO='Sl_Utr';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","diac_lu" => "Direccion Actual","esta_lu" => "Estado Logico","esta_lut" => "esta_lut","lotc_lu" => "Codigo de Lote Relacionado","lotn_lu" => "Numero de Lote Relacionado","cmov_lu" => "Codigo de Movimiento","nmov_lu" => "Numero de Movimiento","tipo_lu" => "Tipo de UT","cant_lu" => "Cantidad Original de la UT","sald_lu" => "Existencia Actual de la UT","rese_lu" => "Cantidad Reservada","cdoc_lu" => "Codigo Documento Relacionado","ndoc_lu" => "Numero de Documento Relacionado","frec_lu" => "Fecha de Ultimo Recuento","esfi_lu" => "En cuarentena","erec_lu" => "Estado de recuento","erec_lut" => "erec_lut","ulti_lu" => "Ultima Tarea","isol_lu" => "Incluida en el SOL?","esti_lu" => "Estado de Rotulado","esti_lut" => "esti_lut","care_lu" => "Cantidad a Reabastecer","fill_lu" => "LIBRE PARA USO FUTURO",
                     );
        return $Campo[$campo];
	}
};
?>
