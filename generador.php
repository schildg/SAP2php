 <?php
include_once ("conector.php");
 if (isset ($_POST['OBJETO'])) {
	$OBJETO = $_POST['OBJETO'];
} else {
	$OBJETO = $_GET['OBJETO'];
}
include_once('DATA_CONF.php');

$columnas=MyActiveRecord::Columns($OBJETO);
$def_cadena_variables = "";
$cadena_columnas = "";
$cadena_corta_columnas = "";
$counter = 0;
foreach ($columnas as $k => $v){
	$dic = MyActiveRecord::FindFirst('Diccionario',"objeto = '".$OBJETO."' and campo = '".$k."'");
	if($dic->descripcion == ""){
		$dic->descripcion=$k;
	}
	if ($k != "date_concurrency"){
		$cadena_columnas = $cadena_columnas."'".$k."',";
		$def_cadena_variables = $def_cadena_variables.'"'.$k.'" => "'.$dic->descripcion.'",';
//		$def_cadena_variables = $def_cadena_variables.'"'.$k.'" => "'.$k.'",';
		$counter++;
		if ($counter <= 5){
			$cadena_corta_columnas = $cadena_corta_columnas."'".$k."',";		
		}
	}
}

//echo $def_cadena_variables;

$objeto=strtolower($OBJETO);
$file_in= fopen("generator/amb-objeto.txt" , "r");
$file_out= fopen("amb-$objeto.php" , "w");

if ($file_in) {
	while ($cadena= fgets($file_in)){
		$cadena=ereg_replace('ClaseObjeto',$OBJETO,$cadena);
		$cadena=ereg_replace('variaObjeto',$objeto,$cadena);
		$cadena=ereg_replace('@id_cadena@',$cadena_columnas,$cadena);
		fwrite($file_out,$cadena);
   }
	
}
fclose ($file_in);
fclose ($file_out);

//******************************************************

$file_in= fopen("generator/Objeto.txt" , "r");
$file_out= fopen("Clases/$OBJETO.php" , "w");

if ($file_in) {
	while ($cadena= fgets($file_in)){
		$cadena=ereg_replace('ClaseObjeto',$OBJETO,$cadena);
		$cadena=ereg_replace('variaObjeto',$objeto,$cadena);
		$cadena=ereg_replace('@id_variable@',$def_cadena_variables,$cadena);
		fwrite($file_out,$cadena);
   }
	
}
fclose ($file_in);
fclose ($file_out);




//******************************************************


$file_in= fopen("generator/docpdf-objeto.txt" , "r");
$file_out= fopen("docpdf-$objeto.php" , "w");

if ($file_in) {
	while ($cadena= fgets($file_in)){
		$cadena=ereg_replace('ClaseObjeto',$OBJETO,$cadena);
		$cadena=ereg_replace('variaObjeto',$objeto,$cadena);
		$cadena=ereg_replace('@id_cadena@',$cadena_corta_columnas,$cadena);
		fwrite($file_out,$cadena);
   }
	
}
fclose ($file_in);
fclose ($file_out);




//******************************************************


$file_in= fopen("generator/filtro-objeto.txt" , "r");
$file_out= fopen("filtro-$objeto.php" , "w");

if ($file_in) {
	while ($cadena= fgets($file_in)){
		$cadena=ereg_replace('ClaseObjeto',$OBJETO,$cadena);
		$cadena=ereg_replace('variaObjeto',$objeto,$cadena);
		$cadena=ereg_replace('@id_cadena@',$cadena_columnas,$cadena);
		fwrite($file_out,$cadena);
   }
	
}
fclose ($file_in);
fclose ($file_out);




//******************************************************


$file_in= fopen("generator/listarObjeto.txt" , "r");
$file_out= fopen("listar$OBJETO.php" , "w");

if ($file_in) {
	while ($cadena= fgets($file_in)){
		$cadena=ereg_replace('ClaseObjeto',$OBJETO,$cadena);
		$cadena=ereg_replace('variaObjeto',$objeto,$cadena);
		$cadena=ereg_replace('@id_cadena@',$cadena_corta_columnas,$cadena);
		fwrite($file_out,$cadena);
   }
	
}
fclose ($file_in);
fclose ($file_out);



//******************************************************


$file_in= fopen("generator/pdf-objeto.txt" , "r");
$file_out= fopen("pdf-$objeto.php" , "w");

if ($file_in) {
	while ($cadena= fgets($file_in)){
		$cadena=ereg_replace('ClaseObjeto',$OBJETO,$cadena);
		$cadena=ereg_replace('variaObjeto',$objeto,$cadena);
		$cadena=ereg_replace('@id_cadena@',$cadena_corta_columnas,$cadena);
		fwrite($file_out,$cadena);
   }
	
}
fclose ($file_in);
fclose ($file_out);

echo "se genero correctamente   $OBJETO";


include_once("Clases/Diccionario.php");
include_once("Clases/Menu.php");
include_once("Clases/Accion.php");
include_once("Clases/Permiso.php");
include_once("Clases/Accion_Menu.php");
/*
$columnas=MyActiveRecord::Columns($OBJETO);
foreach ($columnas as $k => $v){
	$diccionario=new Diccionario();
	$diccionario->objeto=$OBJETO;
	$diccionario->campo=$k;
	$diccionario->es_foraneo=0;
	$diccionario->es_unico=0;
	if ($k != "date_concurrency"){
		$diccionario->gene_historia = 1;
	}else{
		$diccionario->gene_historia = 0;
	}
	$diccionario->save();
}

*/


$menu = new Menu();
$menu->habilitado = 1;
$menu->denominacion = "Adm. ".$OBJETO;
$menu->save();


$accion=new Accion();
$accion->modulo="amb-$objeto.php";
$accion->comando=$OBJETO;
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="amb-$objeto.php";
$accion->comando="alta$OBJETO";
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->rotulo="Alta de $OBJETO";
$accion->habilitado=1;
$accion->save();
$accion_menu=new Accion_Menu();
$accion_menu->menu_id=13;
$accion_menu->accion_id=$accion->id;
$accion_menu->habilitado=1;
$accion_menu->save();
$accion_menu=new Accion_Menu();
$accion_menu->menu_id=$menu->id;
$accion_menu->accion_id=$accion->id;
$accion_menu->habilitado=1;
$accion_menu->save();

$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="amb-$objeto.php";
$accion->comando="editar".$OBJETO;
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="amb-$objeto.php";
$accion->comando="borrar".$OBJETO;
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="listar$OBJETO.php";
$accion->comando="adm".$OBJETO;
$accion->rotulo="Listador de $OBJETO";
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$accion_menu=new Accion_Menu();
$accion_menu->menu_id=14;
$accion_menu->accion_id=$accion->id;
$accion_menu->habilitado=1;
$accion_menu->save();
$accion_menu=new Accion_Menu();
$accion_menu->menu_id=$menu->id;
$accion_menu->accion_id=$accion->id;
$accion_menu->habilitado=1;
$accion_menu->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="listar$OBJETO.php";
$accion->comando="listar".$OBJETO;
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="filtro-$objeto.php";
$accion->rotulo="Filtro de $OBJETO";
$accion->comando="filtro".$OBJETO;
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$accion_menu=new Accion_Menu();
$accion_menu->menu_id=15;
$accion_menu->accion_id=$accion->id;
$accion_menu->habilitado=1;
$accion_menu->save();
$accion_menu=new Accion_Menu();
$accion_menu->menu_id=$menu->id;
$accion_menu->accion_id=$accion->id;
$accion_menu->habilitado=1;
$accion_menu->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="pdf-$objeto.php";
$accion->comando=$OBJETO."PDF";
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="docpdf-$objeto.php";
$accion->comando="doc".$OBJETO."PDF";
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="listarAttachados.php";
$accion->comando="VerAttach".$OBJETO;
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();
$accion=new Accion();
$accion->modulo="manAttachador.php";
$accion->comando="Attach".$OBJETO;
$accion->fecha== $accion->DbDateTime(time()-3600);;
$accion->habilitado=1;
$accion->save();
$permiso = new Permiso();
$permiso->habilitado=1;
$permiso->usuario_id=28;
$permiso->accion_id=$accion->id;
$permiso->save();

?> 