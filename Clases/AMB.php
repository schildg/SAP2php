<?php
require_once('Smarty.Class.php');
include_once('DATA_CONF.php');
class AMB extends MyActiveRecord {
	var $CLASE_OBJETO;
	var $TITULO_OBJETO;
	var $TITULO;
	var $OBJETO;
	var $ECEPCION;
	var $CAMPOS;
	var $TPL;
	var $URL_ULTIMA;
	var $URL_ANTEULTIMA;
		
	function AMB($objeto) {
		$this->CLASE_OBJETO=$objeto;
		$this->OBJETO=MyActiveRecord::Create($this->CLASE_OBJETO);
		$this->URL_ULTIMA=$_SESSION['url_anterior'];
		$this->URL_ANTEULTIMA=$_SESSION['url_ante_ultima'];
	}
	function cargarObjeto($objeto) {
		$this->OBJETO=$objeto;
	}
	function cargarTplAmb($tpl) {
		$this->TPL=$tpl;
	}
	function cargarTitulo($titulo) {
		$this->TITULO=$titulo;
	}
	function cargarTituloObjeto($titulo_o) {
		$this->TITULO_OBJETO=$titulo_o;
	}
	function cargarEcepcion($ecepcion) {
		$this->ECEPCION=$ecepcion;
	}
	function cargarCampos($campos) {
		$this->CAMPOS=$campos;
	}
	function generarAMB($subobjeto) {
		$smarty = new Smarty();
		$self = $_SERVER['PHP_SELF'];
		include_once ("Tabla.php");
		include_once ("Attach.php");
		$tabla = new Tabla();
		$attach = new Attach();
		$colu= MyActiveRecord::Columns($this->CLASE_OBJETO);
		$columna=array();
		foreach ($colu as $k => $v) {
			if (in_array($k,$this->CAMPOS)){
				$columna[$k]=$v;
			}
		}
		$columna["date_concurrency"]=$objeto->date_concurrency;
		$smarty->assign("columna", $columna);
		$verHistoria = $_GET["verHistoria"];
		if (isset ($_POST['subaccion'])) {
			$subaccion = $_POST['subaccion'];
		} else {
			$subaccion = $_GET['subaccion'];
		};
		if (isset ($_POST['accion'])) {
			$Accion = $_POST['accion'];
		} else {
			$Accion = $_GET['accion'];
		};
		$smarty->assign("self", $self);
		$smarty->assign("attach", $attach);
		$smarty->assign("subobjeto", $subobjeto);
		$smarty->assign("tabla", $tabla);
		$smarty->assign("verHistoria", $verHistoria);
		$smarty->assign("Accion", $Accion);
		$smarty->assign("titulo", $this->TITULO);
		$smarty->assign("url_ultima", $this->URL_ULTIMA);
		$smarty->assign("CAMPOS", $this->CAMPOS);
		$smarty->assign("titulo_objeto", $this->TITULO_OBJETO);
		$smarty->assign("subaccion", $subaccion);
		$smarty->assign("OBJETO", $this->CLASE_OBJETO);
		$smarty->assign("objeto", $this->OBJETO);
		
		if ($verHistoria == 1){
			include_once ("Historia.php");
			$historia = new Historia();
			$listaHistoria=$historia->buscarHistoria($this->CLASE_OBJETO,$_GET["id"]);
			$smarty->assign("listaHistoria", $listaHistoria);
		}
		if ($this->TPL!=""){
			$smarty->display($this->TPL);
		}else{
			$smarty->display('gene_AMB.tpl');
		};
	}
	function ok() {
		$smarty = new Smarty();
		$self = $_SERVER['PHP_SELF'];
		$smarty->assign("url_anteultima", $this->URL_ANTEULTIMA);
		$smarty->display('amb-ok.tpl');
	}
	function ok_del() {
		$smarty = new Smarty();
		$self = $_SERVER['PHP_SELF'];
		$smarty->assign("url_anteultima", $this->URL_ANTEULTIMA);
		$smarty->display('amb-del.tpl');
	}
};
?>
