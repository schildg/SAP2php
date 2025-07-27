<?php
$smarty  = new Smarty();
if (isset ($_POST['upload'])) {
	$upload = $_POST['upload'];
} else {
	$upload = $_GET['upload'];
}

if($upload=='Procesar_Carga_de_Excel'){
$archivo = $_FILES['Planilla_excel']['name'];

$tipo = $_FILES['Planilla_excel']['type'];

$destino = 'tmp/'.date("Ymd")."_E_".$archivo;

copy($_FILES['Planilla_excel']['tmp_name'],$destino);

if($upload=='Procesar_Carga_de_Excel'){
	if (file_exists ($destino)){

			/** Clases necesarias */

		require_once('Clases/PHPExcel.php');
		require_once('Clases/PHPExcel/Reader/Excel2007.php');
		// Cargando la hoja de cálculo
		$objReader = new PHPExcel_Reader_Excel2007();
		$objPHPExcel = $objReader->load($destino);
		// Asignar hoja de excel activa
		
		$objPHPExcel->setActiveSheetIndex(0);
		$tiene_error_en_columnas=false;
		$nombre_columnas='';
//		echo $objPHPExcel->getActiveSheet()->getHighestColumn();
		for ($j = 0; $j <= PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn()); $j++) {
			if (isset($arrCol[$j])){
//				echo $objPHPExcel->getActiveSheet()->getCell($arrCol[$j].'1')->getValue()." != ".$cabecera_excel[$arrCol[$j]]."</br>";
				if($objPHPExcel->getActiveSheet()->getCell($arrCol[$j].'1')->getValue()!=$cabecera_excel[$arrCol[$j]]){
					$tiene_error_en_columnas=true;
				}
				$nombre_columnas=$nombre_columnas.$arrCol[$j]."=".$cabecera_excel[$arrCol[$j]].";";
			}
		}
		if($tiene_error_en_columnas){
			 $msg_error="Error en la carga de los campos del Excel</br>".$nombre_columnas."</br>";
			  
			  $smarty->assign("msg_error", $msg_error);
			  $smarty->display('msg_error.tpl');
			
		}else{
			for ($i = 1; $i <= $objPHPExcel->getActiveSheet()->getHighestRow('A'); $i++) {
				for ($j = 0; $j <= PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestColumn()); $j++) {
					if (isset($arrCol[$j])){			
						$_DATOS_EXCEL[$i][$cabecera_excel[$arrCol[$j]]] = $objPHPExcel->getActiveSheet()->getCell($arrCol[$j].$i)->getValue();
					}
				}
			}
		}
	}
}
//@unlink($_FILES['Planilla_excel']['tmp_name']);
//@unlink($destino);

}else{
  $smarty->assign("self", $self);
  $smarty->assign("titulo_cargador_excel",$titulo_cargador_excel);
  $smarty->assign("accion",$comando_a_ejecutar);
  $smarty->assign("objeto", $objeto);
  $smarty->assign("objeto_id", $objeto_id);
  $smarty->display('man_cargo_excel.tpl');
}	
?>