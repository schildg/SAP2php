<?php
include_once ("Clases/Material.php");
$titulo_cargador_excel="Cargar Lista de Precios a los Materiales";
if (isset ($_POST['accion'])) {
	$comando_a_ejecutar = $_POST['accion'];
} else {
	$comando_a_ejecutar = $_GET['accion'];
}
	
$cabecera_excel['A']='Material';
$cabecera_excel['B']='Descripcion';
$cabecera_excel['C']='Precio_Piso';
$cabecera_excel['D']='Precio_Promedio';

$arrCol= array(0=>'A',1=>'B',2=>'C',3=>'D');

include_once ("man_cargo_excel.php");


if (isset($_DATOS_EXCEL)){
	echo '<table>';
	for ($i = 1; $i <= $objPHPExcel->getActiveSheet()->getHighestRow('A'); $i++) {
		echo '<tr><td>'.$i.'</td><td>'.$_DATOS_EXCEL[$i]['Material'].'</td><td>'.$_DATOS_EXCEL[$i]['Precio_Piso'].'</td><td>'.$_DATOS_EXCEL[$i]['Precio_Promedio'].'</td></tr>';
	}
	echo '</table>';
	
	for ($i = 2; $i <= $objPHPExcel->getActiveSheet()->getHighestRow('A'); $i++) {
	   $mat = new Material();
	   if($mat->existe('000000000'.$_DATOS_EXCEL[$i]['Material'])){
	       $mat = $mat->buscarExtendido('000000000'.$_DATOS_EXCEL[$i]['Material']);
	       $mat->PRECIO_LISTADO=$_DATOS_EXCEL[$i]['Precio_Promedio'];
	       $mat->PRECIO_PISO=$_DATOS_EXCEL[$i]['Precio_Piso'];
	       $mat->save();
	   }else{
			 $msg_error="Error en la carga de los datos del Excel</br>No existe el material ".$_DATOS_EXCEL[$i]['Material']."</br>";
			  
			  $smarty->assign("msg_error", $msg_error);
			  $smarty->display('msg_error.tpl');
			  break;
	   	
	   }
	}
	
}


@unlink($_FILES['Planilla_excel']['tmp_name']);
@unlink($destino);



?>