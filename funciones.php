<?php
function strtodate($valor){
	$dia=substr($valor,0,2);
	$mes=substr($valor,3,2);
	$ano=substr($valor,6,4);
	return date('Y-m-d', strtotime($ano."-".$mes."-".$dia));
		
};
function strtodatedmy($valor){
	$dia=substr($valor,8,2);
	$mes=substr($valor,5,2);
	$ano=substr($valor,0,4);
	return $dia."/".$mes."/".$ano;
		
};
function getUltimoDiaMes($elAnio,$elMes) {
   if (((fmod($elAnio,4)==0) and (fmod($elAnio,100)!=0)) or (fmod($elAnio,400)==0)) {
       $dias_febrero = 29;
   } else {
       $dias_febrero = 28;
   }
   switch($elMes) {
       case '01': return 31; break;
       case '02': return $dias_febrero; break;
       case '03': return 31; break;
       case '04': return 30; break;
       case '05': return 31; break;
       case '06': return 30; break;
       case '07': return 31; break;
       case '08': return 31; break;
       case '09': return 30; break;
       case '10': return 31; break;
       case '11': return 30; break;
       case '12': return 31; break;
   }
	
}
function cargo_sin_duplicados($lista_de_arreglo, $el_array) {
	$lista_aux = $lista_de_arreglo;
	if (empty($lista_de_arreglo)){
		$lista_aux=array();
	}else{
		foreach ($lista_de_arreglo as $arr){
			$es_igual = true;
	//		echo "paso 1 ".$el_array[MAT_DOC]."  ".$arr[MAT_DOC]."\r\n";
			foreach ($el_array as $k => $v){
				if ($arr[$k]!=$el_array[$k] && $es_igual){
					$es_igual = false;
	//				echo "paso 2 ".$k." ".$el_array[$k]." ".$k." ".$arr[$k]."\r\n";
				}
			}
			if($es_igual){
				break;
			}
		}
	}
	if($es_igual==false || empty($lista_aux)){
		array_push($lista_aux, $el_array);
//		echo "paso 3 ".$el_array[MAT_DOC]."\r\n";
	}
	return $lista_aux;
}
function cargo_sin_duplicadosV2($lista_de_arreglo,$clave, $el_array) {
	if(!array_key_exists($clave, $lista_de_arreglo)){
		$lista_de_arreglo[$clave] = $el_array;
	}
	return $lista_de_arreglo;
}
function busco_en_arregloV2($lista_de_arreglo, $clave) {
	if(array_key_exists($clave, $lista_de_arreglo)){
		return $lista_de_arreglo[$clave];
	}else{
		return false;
	}
}

function busco_en_arreglo($lista_de_arreglo, $campo, $valor) {
	foreach ($lista_de_arreglo as $arr){
		if ($arr[$campo]==$valor){
			return $arr;
		}
	}
}
function cargar_sql($FIELDS,$DATA,$tabla,$clave,$modo,$serv,$separador=";") {
	foreach ($DATA as $cad) {
		if (!$serv->is_running()){break;}		
		
		$str= $cad[WA];	
		
		$csv= explode($separador,$str);
		$i=0;
		foreach ($csv as $valor){
			$obj[$FIELDS[$i][FIELDNAME]]=$valor;
//			echo $FIELDS[$i][FIELDNAME]." - ".$FIELDS[$i][TYPE]." - ".$valor."\r\n";
			$i=$i+1;
		}
		$cuenta=count($obj);
		switch ($modo) {
			case "I":	$sql="INSERT INTO $tabla (";
						$sql_valor="";
						$sql_update="";
						break;
			case "U":	$sql="UPDATE $tabla SET ";
						$sql_update="";
						$sql_where=" WHERE ";
						$pri=1;
						break;
			case "D":	$sql="DELETE FROM $tabla ";
						$sql_where=" WHERE ";
						$pri=1;
						$sql_valor="";
						$sql_update="";
						break;
		}
		$i=0;
		foreach ($obj as $k=>$vY){
			$cuenta=$cuenta-1;
			$vY=trim($vY);
			switch ($FIELDS[$i][TYPE]) {
				case "C":
					$vY=str_replace(",","",str_replace("'","",$vY));
					$v="'".$vY."'";
					break;
				case "T":
					$v="'".$vY."'";
					break;
				case "N":
					if($vY==""){
						$vY=0;
					}
					$v=$vY;
					break;
				case "D":
					$v="'".$vY."'";
					break;
				case "P":
					if(strpos($vY,"-")){
						$v=str_replace("-","",$vY);
						$v="-".$v;
					}else{
						$v=$vY;
					}
					if(!is_numeric($v)){
						$v=0;
					}
					break;				
				default:
					$v=$vY;
					break;
			}
			switch ($modo) {
				case "I":	if($cuenta==0){
								$sql=$sql.$k.") VALUES (";
							}else{
								$sql=$sql.$k.",";
							}
							if($cuenta==0){
								$sql_valor=$sql_valor.$v.") ON DUPLICATE KEY UPDATE ";
							}else{
								$sql_valor=$sql_valor.$v.",";
							}
							if($cuenta==0){
								$sql_update=$sql_update.$k."=".$v;
							}else{
								$sql_update=$sql_update.$k."=".$v.",";
							}
							break;
				case "U":	if(in_array($k,$clave)){
								if($pri){
									$pri=0;
									$sql_where=" WHERE ".$k."=".$v;
								}else{
									$sql_where=$sql_where." AND ".$k."=".$v;
								}
							}
							if($cuenta==0){
								$sql_update=$sql_update.$k."=".$v;
							}else{
								$sql_update=$sql_update.$k."=".$v.",";
							}
							break;
				case "D":	if(in_array($k,$clave)){
								if($pri){
									$pri=0;
									$sql_where=" WHERE ".$k."=".$v;
								}else{
									$sql_where=$sql_where." AND ".$k."=".$v;
								}
							}
							break;
			}
			$i=$i+1;
		}
		switch ($modo) {
			case "I":$sql=$sql.$sql_valor.$sql_update;break;
			case "U":$sql=$sql.$sql_update.$sql_where;break;
			case "D":$sql=$sql.$sql_where;break;
		}
		$sql_ok = true;    
//			echo $sql."\r\n";
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$serv->pongo_hayError($sql."||".$e);
			$sql_ok = false;
//			echo "ERROR::".$sql."||".$e."\r\n";
			return false;
		}
		
		unset($obj,$cad,$sql);
	}
	return true;	
}

function cargar_sql_v2($DATA,$clase_objeto,$clave,$modo,$serv) {
	$campos = MyActiveRecord::Columns($clase_objeto);
	foreach ($DATA as $data_reg) {
		if (!$serv->is_running()){break;}
		
		foreach ($data_reg as $key=>$vY){
			if (isset($campos[$key]['Type'])){
				$val = trim( $vY );		
				if ( get_magic_quotes_gpc() ){
					$val = stripslashes($val);
				}
				$xval="'".mysql_escape_string($val)."'";
				$vals[]=$xval;
				$keys[]="`".$key."`";
				$set[] = "`$key` = $xval";
			}
		}
		switch ($modo) {
		case "I":$sql="INSERT INTO `$clase_objeto` (".implode($keys, ", ").") VALUES (".implode($vals, ", ").")  ON DUPLICATE KEY UPDATE ".implode($set, ", "); break;
//			case "D":$sql=$sql.$sql_where;break;
		}
		$sql_ok = true;
//		echo $sql."\r\n"."\r\n"."\r\n"."\r\n"."\r\n"."\r\n"."\r\n"."\r\n";
		
		try {
			MyActiveRecord :: Query($sql);
		} catch (Exception $e) {
			$serv->pongo_hayError($sql."||".$e);
			$sql_ok = false;
			echo "ERROR::".$sql."||".$e."\r\n";
			return false;
		}
		
		unset($sql,$sql_update,$sql_where,$sql_valor,$xval,$vals,$set,$keys,$val);
	}
	return true;	
}

function cargo_desde_rfc($LDATA,$LISTDESC) {
	$L_Campos= array();
	foreach ($LISTDESC as $valor) {		
		$L_Campos[$valor[FLPOS]]=$valor[FNAMEINT];
	}
	$cadena="";
	foreach ($LDATA as $value) {		
		foreach ($value as $line) {
			$cadena=$cadena.$line;
		}
	}
	$p1=0;
	$reg=0;
	$tabla= array();
	do{//trato los registro de la tabla
		$campo=0;
		do{//trato los campos de un registro
			$campo=$campo+1;		
			$p2=3;
			$cant_caract=substr($cadena, $p1, $p2); 
			$p1=$p1+$p2+1;
			$p2=(int)$cant_caract;
			$valor_caract=substr($cadena, $p1, $p2);
			$p1=$p1+$p2+1;
			$tabla[$reg][$L_Campos[$campo]]=$valor_caract;
		}while (substr($cadena, $p1 -1, 1)==',');
		$reg=$reg+1;
	}while (substr($cadena, $p1 -1, 1)==';' && substr($cadena, $p1, 1)!='/');
	return $tabla;
}


?>