<?php

require_once('Smarty.class.php');

class ExtendOfSmarty extends Smarty {
	var $clase;
	function ExtendOfSmarty() {
		$smarty = new Smarty();
		$smarty->setCompileDir(dirname(__FILE__)."/smarty/templates_c/");
		$smarty->setTemplateDir(dirname(__FILE__)."/smarty/templates/");
		return $smarty;
	}
}
?>
