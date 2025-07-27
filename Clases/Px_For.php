<?php
include_once('DATA_CONF.php');
class Px_For extends SuperClase{
	function Px_For() {
		$this->CLASE_OBJETO='Px_For';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","prod_lv" => "Producto","form_lv" => "Numero de Formula","cmov_lv" => "Codigo de documento","nmov_lv" => "Numero de documento","nomb_lv" => "Nombre","fech_lv" => "Fecha de alta de la formula","suma_lv" => "Sumatoria de kilos","exci_lv" => "Codigo del producto que es exipiente","habi_lv" => "Habilitacion de la formula","habi_lvt" => "habi_lvt","cdor_lv" => "Contador de usos de la formula","cost_lv" => "Se usa para costear?","ubue_lv" => "Se puede usar en BUE?","tipo_lv" => "Tipo de formula","tipo_lvt" => "tipo_lvt","mezc_lv" => "Pre mezclado?","mini_lv" => "Cantidad Minima","pace_lv" => "Aceitador","maxi_lv" => "Cantidad Maxima","toke_lv" => "Lo tiene","cadi_lv" => "Cantidad Adicional","cfor_lv" => "Costo de estimacion de formula","fcof_lv" => "Fecha en la que se estimo el costeo","line_lv" => "Linea de Fabricacion","line_lvt" => "line_lvt","firm_lv" => "Departamento","firm_lvt" => "firm_lvt","fill_lv" => "LIBRE PARA USO FUTURO",
                     );
        return $Campo[$campo];
	}
};
?>
