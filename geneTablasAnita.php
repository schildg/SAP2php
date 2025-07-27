<?php
$smarty  = new Smarty();
include_once ("Clases/Sf_Arc.php");
include_once ("Clases/Sf_Dic.php");
$sf_arc = new Sf_Arc();
$sf_dic = new Sf_Dic();
$relacion=$sf_arc;

if (isset ($_POST['sf_arc_id'])) {
	$sf_arc_id = $_POST['sf_arc_id'];
} else {
	$sf_arc_id = $_GET['sf_arc_id'];
}

$sf_arc=$sf_arc->buscar($sf_arc_id);

if (isset ($_POST['accion'])) {
	$accion = $_POST['accion'];
} else {
	$accion = $_GET['accion'];
}


if($accion=="generarTablasAnita" && $sf_arc_id!=0){
	$arreglo_sql = array();
	$arreglo_sql_diccionario = array();
	$reg_sf_arc = str_replace("-","_",$sf_arc->nreg_sf);
	$sql = "CREATE TABLE `".$reg_sf_arc."` ( `id` int(11) NOT NULL AUTO_INCREMENT,`date_concurrency` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1;";
	array_push($arreglo_sql, $sql);
	$sfdic_lista = $sf_dic->FindAll('Sf_Dic','letr_di ="'.$sf_arc->letr_sf.'"','line_di ASC');
	$campo_anterior = "id";
	$trato_occurs = 0; $occurs=0;
	$gene_diccionario = 0;
	foreach ($sfdic_lista as $sf_dic){
		//echo $sf_dic->tipo_di."   ".$sf_dic->occu_di."   ".$sf_dic->nomb_di."<br>";
		if($sf_dic->tipo_di!=0 || ($sf_dic->tipo_di==0 && $sf_dic->clas_di==9)){
			$es_vatab = 0;
			switch ($sf_dic->clas_di) {
				case 0:
				case 2:
				case 3:
				case 4:	switch ($sf_dic->tipo_di) {
							case 1: if($sf_dic->clas_di==2 ||$sf_dic->clas_di==3 ||$sf_dic->clas_di==4){ 
								       $tipo_dato = "varbinary(".$sf_dic->long_di.") ";
								       $tipo_dato_vatab = "varchar(10) COLLATE latin1_general_ci";
								       if($sf_dic->then_di=="NUME-VT" || $sf_dic->then_di=="CODI-VT"){
										$es_vatab = 1;
								       }
									}elseif($sf_dic->then_di=="NUME-VT" || $sf_dic->then_di=="CODI-VT"){
										$tipo_dato = "char(3) COLLATE latin1_general_ci";
								        $tipo_dato_vatab = "varchar(10) COLLATE latin1_general_ci";
										$es_vatab = 1;
									}else{
								       $tipo_dato = "varchar(".$sf_dic->long_di.")  COLLATE latin1_general_ci";
									}
							break;
							case 2: if($sf_dic->then_di=="NUME-VT" || $sf_dic->then_di=="CODI-VT"){
										$tipo_dato = "char(3) COLLATE latin1_general_ci";
								        $tipo_dato_vatab = "varchar(10) COLLATE latin1_general_ci";
										$es_vatab = 1;
									}elseif($sf_dic->deci_di!=0){
										if($sf_dic->long_di>=$sf_dic->deci_di){$d=$sf_dic->long_di;}else{$d=$sf_dic->deci_di;}
										$tipo_dato ="decimal(".$d.",".$d=$sf_dic->deci_di.")";
									}elseif ($sf_dic->long_di==1){
										$tipo_dato ="tinyint(1)";
									}elseif (!$sf_dic->deci_di) {
										$tipo_dato= "int(".$sf_dic->long_di.")";
									}
							break;
							case 3:
							case 4: $tipo_dato = "date";
							break;
						}
//						echo $trato_occurs." campo ".$sf_dic->nomb_di." nivel ".$sf_dic->nive_di." ocurs ".$sf_dic->occu_di."<br>";
						$comment= "COMMENT '$sf_dic->desc_di' ";
						$comment_vatab= "COMMENT 'TABLA DE $sf_dic->desc_di' ";
						if ($trato_occurs && $sf_dic->nive_di>$nivel){
							for ($i=1;$i<=$occurs;$i++){
								$sql="ALTER TABLE `".$reg_sf_arc."` ADD `".str_replace("-","_",strtolower($sf_dic->nomb_di)).str_pad($i,3,"0",STR_PAD_LEFT)."` ".$tipo_dato." NOT NULL ".$comment." AFTER `".$campo_anterior."`;";
								array_push($arreglo_sql, $sql);
								$campo_anterior=str_replace("-","_",strtolower($sf_dic->nomb_di).str_pad($i,3,"0",STR_PAD_LEFT));
								if ($es_vatab){
									$sql="ALTER TABLE `".$reg_sf_arc."` ADD `".str_replace("-","_",strtolower($sf_dic->nomb_di)).str_pad($i,3,"0",STR_PAD_LEFT)."t"."` ".$tipo_dato_vatab." NOT NULL ".$comment_vatab." AFTER `".$campo_anterior."`;";
									array_push($arreglo_sql, $sql);
									$campo_anterior=str_replace("-","_",strtolower($sf_dic->nomb_di).str_pad($i,3,"0",STR_PAD_LEFT)."t");								
								}								
							}							
						}else{
							$comment= "COMMENT '$sf_dic->desc_di' ";
							$comment_vatab= "COMMENT 'TABLA DE $sf_dic->desc_di' ";
							$trato_occurs = 0; $occurs=0;
							$sql="ALTER TABLE `".$reg_sf_arc."` ADD `".str_replace("-","_",strtolower($sf_dic->nomb_di))."` ".$tipo_dato." NOT NULL ".$comment." AFTER `".$campo_anterior."`;";
							$sql_diccionario = "INSERT INTO `diccionario` SET `objeto`='".strtoupper($reg_sf_arc[0]).$reg_sf_arc[1].$reg_sf_arc[2].strtoupper($reg_sf_arc[3]).$reg_sf_arc[4].$reg_sf_arc[5]."', `descripcion`='".$sf_dic->desc_di."', `campo`='".strtolower(str_replace("-","_",$sf_dic->nomb_di))."', `gene_historia` = 0, `es_unico` = 0, `es_foraneo` =0, `leyenda`='".$sf_dic->desc_di."';";
							array_push($arreglo_sql, $sql);
							array_push($arreglo_sql_diccionario,$sql_diccionario);
							$campo_anterior=str_replace("-","_",strtolower($sf_dic->nomb_di));
							if ($es_vatab){
								$sql="ALTER TABLE `".$reg_sf_arc."` ADD `".str_replace("-","_",strtolower($sf_dic->nomb_di))."t"."` ".$tipo_dato_vatab." NOT NULL ".$comment_vatab." AFTER `".$campo_anterior."`;";
								array_push($arreglo_sql, $sql);
								$campo_anterior=str_replace("-","_",strtolower($sf_dic->nomb_di)."t");								
							}								
						}
						break;
				case 9: $trato_occurs = 1;
				        $nivel=$sf_dic->nive_di;
				        $occurs=$sf_dic->occu_di;
			//	        echo ">>>>>>>>>>>>>>>>>>>>>>>>>>".$sf_dic->nive_di."<<<".$sf_dic->occu_di.">>>>".$sf_dic->nreg_sf;
				}
			}
		}
		$sfdic_lista = $sf_dic->FindAll('Sf_Dic','letr_di ="'.$sf_arc->letr_sf.'"','line_di ASC');
		$clave = "ALTER TABLE `".$reg_sf_arc."` ADD UNIQUE KEY (";
		$simbolo_coma= "";
		foreach ($sfdic_lista as $sf_dic){
			if($sf_dic->tipo_di!=0){
				switch ($sf_dic->clas_di) {
					case 3:
					case 4: $clave = $clave.$simbolo_coma." `".str_replace("-","_",strtolower($sf_dic->nomb_di))."` ";
					        $simbolo_coma = ",";
						break;
				}
			}
		}
		$clave = $clave.');';

		array_push($arreglo_sql, $clave);
		
		
		
		$arreglo_sql_completo = array();
		$arreglo = array();	
		foreach ($arreglo_sql as $sql) {
			$arreglo["sql"]=$sql;
			$arreglo["error"]=false;
			$arreglo["mensaje_e"]="";
			try {
				MyActiveRecord :: Query($sql);
				array_push($arreglo_sql_completo, $arreglo);
			} catch (Exception $e) {
				$arreglo["sql"]=$sql;
				$arreglo["error"]=true;
				$arreglo["mensaje_e"]=$e;
				array_push($arreglo_sql_completo, $arreglo);
			}			        
		}
			
		$arreglo_sql_completo_diccionario = array();
		$arreglo = array();	
		foreach ($arreglo_sql_diccionario as $sql) {
			$arreglo["sql"]=$sql;
			$arreglo["error"]=false;
			$arreglo["mensaje_e"]="";
			try {
				MyActiveRecord :: Query($sql);
				array_push($arreglo_sql_completo_diccionario, $arreglo);
			} catch (Exception $e) {
				$arreglo["sql"]=$sql;
				$arreglo["error"]=true;
				$arreglo["mensaje_e"]=$e;
				array_push($arreglo_sql_completo_diccionario, $arreglo);
			}			        
		}	
		
	}
	
$smarty->assign("self", $self);
$smarty->assign("sf_arc", $sf_arc);
$smarty->assign("relacion", $relacion);
$smarty->assign("arreglo_sql_completo", $arreglo_sql_completo);
$smarty->assign("arreglo_sql_completo_diccionario", $arreglo_sql_completo_diccionario);

$smarty->display('geneTablasAnita.tpl');
?>



