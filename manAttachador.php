<?php
$smarty  = new Smarty();
include_once ("Clases/Attach.php");
$attach = new Attach();
if(isset($_POST['objeto_id'])){
	$objeto_id=$_POST['objeto_id'];
	$objeto=$_POST['objeto'];
}else{
	$objeto_id= $_GET['objeto_id'];
	$objeto=substr($accion,6);
}
if($accion=='AttachObjeto'){
  // Constantes
  # Altura de el thumbnail en píxeles
  define("ALTURA", 100);
  # Nombre del archivo temporal del thumbnail
//  define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
  define("NAMETHUMB", "tmp/thumbtemp"); //y te olvidas de los problemas de permisos
  // Mime types permitidos
  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
  // Variables de la attach
  $name = $_FILES["attach"]["name"];
  $type = $_FILES["attach"]["type"];
  $tmp_name = $_FILES["attach"]["tmp_name"];
  $size = $_FILES["attach"]["size"];
  // Verificamos si el archivo es una imagen válida
/*  if(!in_array($type, $mimetypes))
    die("El archivo que subiste no es una imagen válida");
  // Creando el thumbnail*/
  if (in_array($type, $mimetypes))
  switch($type) {
    case $mimetypes[0]:
    case $mimetypes[1]:
      $img = imagecreatefromjpeg($tmp_name);
      break;
    case $mimetypes[2]:
      $img = imagecreatefromgif($tmp_name);
      break;
    case $mimetypes[3]:
      $img = imagecreatefrompng($tmp_name);
      break;
  $datos = getimagesize($tmp_name);
  $ratio = ($datos[1]/ALTURA);
  $ancho = round($datos[0]/$ratio);
  $thumb = imagecreatetruecolor($ancho, ALTURA);
  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, ALTURA, $datos[0], $datos[1]);
  switch($type) {
    case $mimetypes[0]:
    case $mimetypes[1]:
      imagejpeg($thumb, NAMETHUMB);
	  break;
    case $mimetypes[2]:
      imagegif($thumb, NAMETHUMB);
      break;
    case $mimetypes[3]:
      imagepng($thumb, NAMETHUMB);
      break;
  }
  $fp = fopen(NAMETHUMB, "rb");
  $tthumb = fread($fp, filesize(NAMETHUMB));
  $tthumb = addslashes($tthumb);
  fclose($fp);
  }else{
	$type=$_FILES["attach"]["type"];
  }
  $fp = fopen($tmp_name, "r");
  $tattach = fread($fp, filesize($tmp_name));
  $tattach = addslashes($tattach);
  fclose($fp);
  # contenido del thumbnail
  // Borra archivos temporales si es que existen
  @unlink($tmp_name);
  @unlink(NAMETHUMB);
  // Guardamos todo en la base de datos
  #nombre de la attach
  $nombre = $_POST["nombre"];
  $obj_attach=new Attach();
  $obj_attach->nombre=$nombre;
  $obj_attach->tmp_name=$name;
  $obj_attach->objeto=$objeto;
  $obj_attach->objeto_id=$objeto_id;
  $obj_attach->attach=$tattach;
  $obj_attach->thumb=$tthumb;
  $obj_attach->mime=$type;
  $obj_attach->save();
  $smarty->display('amb-ok.tpl');
}else{
  $smarty->assign("self", $self);
  $smarty->assign("objeto", $objeto);
  $smarty->assign("objeto_id", $objeto_id);
  $smarty->display('manAttachador.tpl');
}	
?>