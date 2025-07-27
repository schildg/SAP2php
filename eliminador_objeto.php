 <?php
include_once ("conector.php");
 if (isset ($_POST['OBJETO'])) {
	$OBJETO = $_POST['OBJETO'];
} else {
	$OBJETO = $_GET['OBJETO'];
}
include_once('DATA_CONF.php');

	try {
$columnas=MyActiveRecord::Columns($OBJETO);
$def_cadena_variables = "";
$cadena_columnas = "";
$cadena_corta_columnas = "";
$counter = 0;
foreach ($columnas as $k => $v){
	$dic = New Diccionario();
	$dic = $dic->FindFirst('Diccionario',"objeto = '".$OBJETO."' and campo = '".$k."'");
	if ($dic){
		$dic->destroy();
	}
}
//echo $def_cadena_variables;
	} catch (Exception $e) {
		$sql_ok = false;
	}

$objeto=strtolower($OBJETO);
unlink("amb-$objeto.php");


//******************************************************

unlink("Clases/$OBJETO.php");

//******************************************************


unlink("docpdf-$objeto.php");

//******************************************************


unlink("filtro-$objeto.php" );


//******************************************************


unlink("listar$OBJETO.php");


//******************************************************


unlink("pdf-$objeto.php");

echo "se elimino correctamente   $OBJETO";


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


$sql="delete from accion where comando = '".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = 'alta".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}

$sql="delete from accion where comando = 'editar".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = 'borrar".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = 'adm".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = 'listar".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = 'filtro".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = '".$OBJETO."PDF'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = 'doc".$OBJETO."PDF'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = 'VerAttach".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}
$sql="delete from accion where comando = 'Attach".$OBJETO."'";
try {
	$result = MyActiveRecord :: Query($sql);
} catch (Exception $e) {
	$sql_ok = false;
}

	$sql="delete accion_menu from accion_menu left join accion on accion.id=accion_menu.accion_id where accion.id is null";
	try {
		$result = MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$sql_ok = false;
	}


	$sql="delete permiso from permiso left join accion on accion.id=permiso.accion_id where accion.id is null";
	try {
		$result = MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$sql_ok = false;
	}

	$sql="delete from historia where objeto='.$OBJETO.'";
	try {
		$result = MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$sql_ok = false;
	}

	$sql="delete menu_menu from menu_menu left join menu on menu_menu.menu_id1=menu.id where menu.id is null";
	try {
		$result = MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$sql_ok = false;
	}

	
	$sql="DROP TABLE $OBJETO";
	try {
		$result = MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$sql_ok = false;
	}
	
		
	
$menu = new Menu();
$menu=MyActiveRecord::FindFirst('Menu',"denominacion = 'Adm. ".$OBJETO."'");
	
	$sql="delete from menu_menu where menu_id1=$menu->id";
	try {
		$result = MyActiveRecord :: Query($sql);
	} catch (Exception $e) {
		$sql_ok = false;
	}

$menu->destroy();

	
	
?> 