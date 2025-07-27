
<?php
 include_once('Clases/DATA_CONF.php');
 ###################
 #
 #
 ###################
 ############## Fecha y carpeta de salida
 $fecha_hoy = date("Ymd-His");
 $bak_dir = PATH_BACKUP;
 #$md = "mkdir $bak_dir"; $a = system($md);
 #$ch = "chmod 777 $bak_dir"; $a = system($ch);

############## Base de datos y tablas
 $db_user = $Xuser;
 $db_pass = $Xpass;
 $db_name = $Xdbas;
 $db_host = $Xhost;
 $conexion = mysql_connect($db_host,$db_user,$db_pass);

############## Archivos de Salida
 $salida_db_sql = $bak_dir.$db_name.'-'.$fecha_hoy.'.sql'; // Datos

$salida_db_sqlE = $bak_dir.$db_name.'E-'.$fecha_hoy.'.sql'; //Estructura

############## Mensaje para enviar correo de notificación
$mensaje=date("Y-m-d")." Se hizo el respaldo de las bases de datos: ".$db_name;
 $mensaje .= "<br>Archivos:";
 $mensaje .= "<br>".$bak_dir.$db_name.'-'.$fecha_hoy.'.sql';
 $mensaje .= "<br>".$bak_dir.$db_name.'-'.$fecha_hoy.'.tar.gz';

$mensaje .= "<br>".$bak_dir.$db_name.'E-'.$fecha_hoy.'.sql';
$mensaje .= "<br>".$bak_dir.$db_name.'E-'.$fecha_hoy.'.tar.gz';

# Dumps
 ########## Salida1
 $dump = PHP_MYSQL_PATH."mysqldump.exe --result-file=$salida_db_sql --default-character-set=utf8 --no-create-info --add-locks=FALSE --disable-keys=FALSE --extended-insert --user=$db_user --password=$db_pass $db_name";
 $a = system($dump);


//Estructura
 $dump = PHP_MYSQL_PATH."mysqldump.exe --result-file=$salida_db_sqlE --default-character-set=utf8 --add-locks=FALSE --disable-keys=FALSE --no-data --user=$db_user --password=$db_pass $db_name";
 $a = system($dump);

echo "Backup OK";


















 ###################
 #
 #
 ###################
 ############## Fecha y carpeta de salida
 $fecha_hoy = date("Ymd-His");
 $bak_dir = PATH_BACKUP;
 #$md = "mkdir $bak_dir"; $a = system($md);
 #$ch = "chmod 777 $bak_dir"; $a = system($ch);

############## Base de datos y tablas
 $db_user = $Xuser;
 $db_pass = $Xpass;
 $db_name = "redmine";
 $db_host = $Xhost;
 $conexion = mysql_connect($db_host,$db_user,$db_pass);

############## Archivos de Salida
 $salida_db_sql = $bak_dir.$db_name.'-'.$fecha_hoy.'.sql'; // Datos

$salida_db_sqlE = $bak_dir.$db_name.'E-'.$fecha_hoy.'.sql'; //Estructura

############## Mensaje para enviar correo de notificación
$mensaje=date("Y-m-d")." Se hizo el respaldo de las bases de datos: ".$db_name;
 $mensaje .= "<br>Archivos:";
 $mensaje .= "<br>".$bak_dir.$db_name.'-'.$fecha_hoy.'.sql';
 $mensaje .= "<br>".$bak_dir.$db_name.'-'.$fecha_hoy.'.tar.gz';

$mensaje .= "<br>".$bak_dir.$db_name.'E-'.$fecha_hoy.'.sql';
$mensaje .= "<br>".$bak_dir.$db_name.'E-'.$fecha_hoy.'.tar.gz';

# Dumps
 ########## Salida1
 $dump = PHP_MYSQL_PATH."mysqldump.exe --result-file=$salida_db_sql --default-character-set=utf8 --no-create-info --add-locks=FALSE --disable-keys=FALSE --extended-insert --user=$db_user --password=$db_pass $db_name";
 $a = system($dump);


//Estructura
 $dump = PHP_MYSQL_PATH."mysqldump.exe --result-file=$salida_db_sqlE --default-character-set=utf8 --add-locks=FALSE --disable-keys=FALSE --no-data --user=$db_user --password=$db_pass $db_name";
 $a = system($dump);

echo "Backup OK";


?>