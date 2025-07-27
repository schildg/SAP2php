<?php
  include_once ("conector.php");
  include_once ("Clases/Attach.php");
  $para_attach=$_GET['attach'];
  $miniatura=$_GET['miniatura'];
  $attach = new Attach();
  $attach=$attach->buscarId($para_attach);
  if($miniatura==1){
	define("NAMETHUMB", "tmp/thumbtemp"); 
	$fp = fopen(NAMETHUMB, "a");
	$tthumb = fwrite($fp,$attach->thumb);
	fclose($fp);
/*	header("Content-Type: $attach->mime");
	imagejpeg("NAMETHUMB");
*/
	
  }else{
	header("Content-Type: $attach->mime");
	header("Content-Disposition: attachment; filename=$attach->tmp_name");
  	echo $attach->attach;
  }
?>