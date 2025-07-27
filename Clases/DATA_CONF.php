<?php
/*
 * Created on 17/03/2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
//include_once ("DB.php");

$Xhost = "localhost";
$Xuser = "root";
$Xpass = "En45SswY";
$Xdbas = "sap2php";

include_once 'MyActiveRecord.0.2.php';

define('MYACTIVERECORD_CONNECTION_STR', 'mysql://'.$Xuser.':'.$Xpass.'@'.$Xhost.'/'.$Xdbas);
include_once ("SuperClase.php");
$SuperClase=new SuperClase();
include_once ("Diccionario.php");

/* PRUEBA MANDANTE 120 
define("SAPRFC_ASHOST", "10.87.1.22");
define("SAPRFC_SYSNR", "50");
define("SAPRFC_CLIENT", "120");
define("SAPRFC_USER", "PCOLOMBO");
define("SAPRFC_PASSWD", "quimtia123");
define("SAPRFC_R3NAME", "LSR");
define("SAPRFC_GROUP", "PUBLIC");
define("SAPRFC_LANG", "EN");
define("SAPRFC_CODEPAGE", "1100"); */

/* PRUEBA MANDANTE 310 
define("SAPRFC_ASHOST", "10.87.1.22");
define("SAPRFC_SYSNR", "51");
define("SAPRFC_CLIENT", "310");
define("SAPRFC_USER", "DTRAVERSO");
define("SAPRFC_PASSWD", "Quimtia2015");
define("SAPRFC_R3NAME", "LSR");
define("SAPRFC_GROUP", "PUBLIC");
define("SAPRFC_LANG", "EN");
define("SAPRFC_CODEPAGE", "1100");  */ 

/* PRUEBA MANDANTE 300 */
//define("SAPRFC_ASHOST", "10.87.1.26");
//define("SAPRFC_SYSNR", "52");
//define("SAPRFC_ASHOST", "/H/200.5.119.45");
define("SAPRFC_ASHOST", "10.209.184.214");
define("SAPRFC_SYSNR", "52");
define("SAPRFC_CLIENT", "300");
define("SAPRFC_USER", "USUARIOCRM");
define("SAPRFC_PASSWD","QiTK32hHH?");
define("SAPRFC_R3NAME", "LSR");
define("SAPRFC_GROUP", "PUBLIC");
define("SAPRFC_LANG", "ES");
define("SAPRFC_CODEPAGE", "1100"); 



define("PHP_EXE_PATH", "C:/xampp/php/php.exe");
define("PHP_MYSQL_PATH", "C:/xampp/mysql/bin/");
define("LOGS_PATH", "C:/Sistema_php_anita/nosap/logs/");
define("FLAGS_PATH", "C:/Sistema_php_anita/nosap/flags/");
define("PATH_SAP2PHP_RAIZ", "C:/Sistema_anita_php/Portal/SAP2php/");
define("PATH_ANITA_RAIZ", "C:/Sistema_anita_php/");


//define("PATH_NOVEDADES_SALIDA_CONTROL",  'Q:/entrada/control/');
//define("PATH_NOVEDADES_SALIDA",  'Q:/entrada/paquetes/');
//define("PATH_NOVEDADES_ENTRADA", 'Q:/salida/espera/');
//define("PATH_NOVEDADES_ENTRADA_ACUMULA", 'Q:/salida/acumula/');

//define("PATH_NOVEDADES_SALIDA_CONTROL",  "C:/nosap/entrada/paquetes/");
//define("PATH_NOVEDADES_SALIDA",  "C:/nosap/entrada/paquetes/");
//define("PATH_NOVEDADES_ENTRADA", "C:/nosap/salida/espera/");

//define("PATH_NOVEDADES_SALIDA_CONTROL",  '//insaprx/nosap/entrada/control/');
//define("PATH_NOVEDADES_SALIDA",  '//insaprx/nosap/entrada/paquetes/');
//define("PATH_NOVEDADES_ENTRADA", '//insaprx/nosap/salida/espera/');
//define("PATH_NOVEDADES_ENTRADA_ACUMULA", '//insaprx/nosap/salida/acumula/');

define("PATH_NOVEDADES_SALIDA_CONTROL",  '//10.3.1.2/nosap/entrada/control/');
define("PATH_NOVEDADES_SALIDA",  '//10.3.1.2/nosap/entrada/paquetes/');
define("PATH_NOVEDADES_ENTRADA", '//10.3.1.2/nosap/salida/espera/');
define("PATH_NOVEDADES_ENTRADA_ACUMULA", '//10.3.1.2/nosap/salida/acumula/');



define("PATH_BACKUP",  "C:/Sistema_php_anita/nosap/backup/");
date_default_timezone_set('America/Argentina/Buenos_Aires'); 

?>
