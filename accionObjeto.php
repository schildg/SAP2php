<?php
	$columna= MyActiveRecord::Columns($OBJETO);
	$objeto=MyActiveRecord::Create($OBJETO);
	if($_POST["id"]!=0){
		$objeto = $objeto->buscar($_POST["id"]);
	};
	foreach ($columna as $k => $v) {
		if(isset($_FILES["$k"])){
			if ($objeto->GetType($OBJETO,$k)=="blob" or $objeto->GetType($OBJETO,$k)=="longblob"){
				  $mimetypes = array("image/jpeg", "image/pjpeg", "image/png");
				  // Variables de la attach
				  $name = $_FILES["$k"]["name"];
				  $type = $_FILES["$k"]["type"];
				  $tmp_name = $_FILES["$k"]["tmp_name"];
				  $size = $_FILES["$k"]["size"];
				  if (!($name == "" and $type == "" and $tmp_name == "")){
					  if (in_array($type, $mimetypes))
						  switch($type) {
						    case $mimetypes[0]:
						    case $mimetypes[1]:
						      $img = imagecreatefromjpeg($tmp_name);
						      break;
						    case $mimetypes[2]:
						      $img = imagecreatefrompng($tmp_name);
						      break;
						  if($size >= 1048576){
							$objeto->add_error($OBJETO,'el archivo excede el limite maximos de 1MB');						  	
						  }
						  $datos = getimagesize($tmp_name);
					  }else{
						$objeto->add_error($OBJETO,'la imagen debe ser un formato un valido de mime-type: image/jpeg image/pjpeg image/gif image/png');		
					  }
					  $fp = fopen($tmp_name, "r");
					  $tattach = fread($fp, filesize($tmp_name));
					  $tattach = addslashes($tattach);
					  fclose($fp);
					  $objeto->$k=$tattach;
					  $xtjk=$k."_mime";
					  $objeto->$xtjk=$type;
	     			  @unlink($tmp_name);
				  }
			}
			}else{
		if(isset($_POST["$k"])){ 
			if($objeto->GetType($OBJETO,$k)=="date"){
			    $objeto->$k=strtodate($_POST[$k]);
			}else{	
					$objeto->$k = $_POST["$k"];
				}
			}
		}
	}
?>
