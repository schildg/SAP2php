<?php
include_once('DATA_CONF.php');
class St_Lar extends SuperClase{
	function St_Lar() {
		$this->CLASE_OBJETO='St_Lar';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","prod_gd" => "Codigo de producto","marc_gd" => "Marca del Articulo","enva_gd" => "Envase del articulo","cenv_gd" => "Cantidad del envase","cmov_gd" => "Codigo de documento","nmov_gd" => "Numero de documento","item_gd" => "Item del documento","site_gd" => "Subitem del documento","cant_gd" => "Cantidad del articulo","prec_gd" => "Precio unitario","sape_gd" => "Saldo pendiente de entrega","sapf_gd" => "Saldo pendiente de factura","cost_gd" => "Costo unitario","refe_gd" => "Referencia","tenv_gd" => "Tipo de envase entregado","forn_gd" => "Codigo de Formula","nfor_gd" => "Numero de Formula","moti_gd" => "Motivo del documento","itom_gd" => "Subtipo de documento","cdo1_gd" => "Codigo 1 de doc. relacionado","ndo1_gd" => "Numero 1 de Doc. de relacionado","cdo2_gd" => "codigo 2 de doc. relacionado","ndo2_gd" => "numero 2 de doc. relacionado","ndo3_gd" => "numero 3 de doc. relacionado","exca_gd" => "Excluir la linea en el calculo de VUC?","cete_gd" => "Codigo de ET","nete_gd" => "Numero de ET","tipo_gd" => "Tipo de Venta","val1_gd" => "Valor 1","val2_gd" => "Valor 2","val3_gd" => "Valor 3","val4_gd" => "Valor 4","val5_gd" => "Valor 5","cprr_gd" => "Codigo de Producto Relacionado","nprr_gd" => "Numero de Producto Relacionado","marr_gd" => "Marca Relacionado","envr_gd" => "Envase Relacionado","cenr_gd" => "Cantidad de Envase Relacionado","fill_gd" => "Libre para uso futuro",
                     );
        return $Campo[$campo];
	}
};
?>
