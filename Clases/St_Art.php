<?php
include_once('DATA_CONF.php');
include_once('St_Pro.php');
include_once('St_Mar.php');
include_once('St_Env.php');
class St_Art extends SuperClase{
	function St_Art() {
		$this->CLASE_OBJETO='St_Art';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","prod_sa" => "Producto","marc_sa" => "Marca","enva_sa" => "Envase","cenv_sa" => "Cantidad del envase","cenr_sa" => "Cantidad real que carga el envase","cceu_sa" => "Coeficiente de Conversion de unidades","pmin_sa" => "Precio minimo permitido","spro_sa" => "Numero de producto sosias","smar_sa" => "Codigo de la marca del sosias","senv_sa" => "Codigo de envase del sosias","scen_sa" => "Cantidad del envase del sosias","soco_sa" => "Coeficiente de conversion del sosias","cant_sa" => "Unidades de articulos en un estado det.","habi_sa" => "Habilitacion","prio_sa" => "Prioridad","arge_sa" => "Industria Argentina","enca_sa" => "Envases por capa","ccap_sa" => "Cantidad de capas","pall_sa" => "Viene palletizado","paan_sa" => "Ancho del pallet","pala_sa" => "Largo del pallet","caan_sa" => "Ancho de pallet cargado","cala_sa" => "Largo de pallet cargado","caal_sa" => "Alto de pallet cargado","insp_sa" => "Numero de producto unificacion","insm_sa" => "Codigo de la marca unificacion","inse_sa" => "Codigo de envase unificacion","insc_sa" => "Cantidad del envase unificacion","uceu_sa" => "Unidad a la que se convierte","impo_sa" => "Importado","desv_sa" => "Nombre Inscripto","sena_sa" => "Inscripcion SENASA","soli_sa" => "Persona que solicita la apertura","pimi_sa" => "Picking Minimo","repo_sa" => "Reposicion","tusp_sa" => "Tipo de Ubicacion Sugerida para Picking","iinv_sa" => "Inscripto Inv?","ppro_sa" => "Numero de producto prestamos","pmar_sa" => "Codigo de la marca del prestamo","penv_sa" => "Codigo de envase del prestamo","pcen_sa" => "Cantidad del envase del prestamo","dens_sa" => "Densidad por litros","enan_sa" => "Ancho del Envase","enla_sa" => "Largo del Envase","enal_sa" => "Alto del Envase","peen_sa" => "Peso del Envase","drep_sa" => "Dias reposicion de Stock","paip_sa" => "Origen Habitual","tran_sa" => "Transporte Habitual","etiq_sa" => "Rotulo por envase","ckos_sa" => "Certificacion Kosher?","fill_sa" => "LIBRE PARA USO FUTURO",
                     );
        return $Campo[$campo];
	}
};
?>
