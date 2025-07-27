<?php
include_once('DATA_CONF.php');
class Centro extends SuperClase{
	function Centro() {
		$this->CLASE_OBJETO='Centro';
	}
	function leyenda() {
		return $this->id;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id","WERKS" => "Centro","NAME1" => "Nombre","BWKEY" => "�mbito de valoraci�n","KUNNR" => "N�mero de cliente del centro","LIFNR" => "N�mero de proveedor del centro","FABKL" => "Clave de identidad para calendario de f�brica","NAME2" => "Nombre 2","STRAS" => "Calle y n�mero","PFACH" => "Apartado","PSTLZ" => "C�digo postal","ORT01" => "Poblaci�n","EKORG" => "Organizaci�n de compras","VKORG" => "Organizaci�n de ventas para compensaci�n interna","CHAZV" => "Indicador: Gesti�n de estado de lote activo","KKOWK" => "Indicador: Condiciones en el nivel de centro","KORDB" => "Indicador: Sujeto a libro de pedidos","BEDPL" => "Activaci�n de la planificaci�n de necesidades","LAND1" => "Clave de pa�s","REGIO" => "Regi�n (Estado federal, provincia, condado)","COUNC" => "C�digo de condado","CITYC" => "C�digo municipal","ADRNR" => "Direcci�n","IWERK" => "Centro de planificaci�n del mantenimiento","TXJCD" => "Domicilio fiscal","VTWEG" => "Canal de distribuci�n para compensaci�n interna","SPART" => "Sector para compensaci�n interna","SPRAS" => "Clave de idioma","WKSOP" => "Centro SOP","AWSLS" => "Clave de desviaci�n","CHAZV_OLD" => "Indicador: Gesti�n de estado de lote activo","VLFKZ" => "Tipo de centro","BZIRK" => "Zona de ventas","ZONE1" => "Regi�n de suministro","TAXIW" => "Identificador de impuestos centro (Compras)","BZQHL" => "Considerar proveedor regular","LET01" => "N�mero de d�as para la primera reclamaci�n","LET02" => "Cantidad de d�as para la segunda reclamaci�n","LET03" => "Cantidad de d�as para la tercera reclamaci�n","TXNAM_MA1" => "Nombre del texto 1� reclamaci�n delcrac.proveedor","TXNAM_MA2" => "Nombres del texto 2� reclamaci�n de declarac.prove","TXNAM_MA3" => "Nombre del texto 3� reclamaci�n declarac.proveedor","BETOL" => "N� de d�as tolerancia pedido - compactaci�n reg. i","J_1BBRANCH" => "Lugar comercial","VTBFI" => "Regla para determinaci�n del �rea de ventas p.tras","FPRFW" => "Perfil de distribuci�n a nivel de centro","ACHVM" => "Petici�n de archivo central p.registro maestro","DVSART" => "Log de lotes: Clase de SGD utilizado","NODETYPE" => "Tipo de nodo de grafo de cadena log�stica","NSCHEMA" => "Esquema para la formaci�n de nombre","PKOSA" => "Conexi�n de la contabilidad de objetos de coste ac","MISCH" => "Actualizaci�n para el c�lculo mixto coste activo","MGVUPD" => "Actualizaci�n para el c�lculo coste real activa","VSTEL" => "Pto.exped./depto.entrada mc�a.","MGVLAUPD" => "Actualizaci�n consumo actividad en estructura cuan","MGVLAREVAL" => "Control del abono de centros de coste","SOURCING" => "Acceso a determin.fuente aprovisionamiento mediant","OILIVAL" => "Indicador de valoraci�n de intercambio","OIHVTYPE" => "Clase de proveedores (refiner�a/f�brica/otros) (Br","OIHCREDIPI" => "Cr�dito IPI permitido","STORETYPE" => "Tp.tienda p.diferenc.tienda, gran almac�n, tienda ","DEP_STORE" => "Grandes almacenes sup.",
                     );
        return $Campo[$campo];
	}
	function buscarExtendido($vWERKS) {
		$rela = MyActiveRecord :: FindFirst($this->CLASE_OBJETO,"WERKS = '$vWERKS'");
		if (!$rela){
			return MyActiveRecord :: Create($this->CLASE_OBJETO);
		}else{
			return $rela;
		};
		
	}
	
};
?>
