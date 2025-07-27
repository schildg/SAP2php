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
		$Campo=array("id" => "id","WERKS" => "Centro","NAME1" => "Nombre","BWKEY" => "Ámbito de valoración","KUNNR" => "Número de cliente del centro","LIFNR" => "Número de proveedor del centro","FABKL" => "Clave de identidad para calendario de fábrica","NAME2" => "Nombre 2","STRAS" => "Calle y número","PFACH" => "Apartado","PSTLZ" => "Código postal","ORT01" => "Población","EKORG" => "Organización de compras","VKORG" => "Organización de ventas para compensación interna","CHAZV" => "Indicador: Gestión de estado de lote activo","KKOWK" => "Indicador: Condiciones en el nivel de centro","KORDB" => "Indicador: Sujeto a libro de pedidos","BEDPL" => "Activación de la planificación de necesidades","LAND1" => "Clave de país","REGIO" => "Región (Estado federal, provincia, condado)","COUNC" => "Código de condado","CITYC" => "Código municipal","ADRNR" => "Dirección","IWERK" => "Centro de planificación del mantenimiento","TXJCD" => "Domicilio fiscal","VTWEG" => "Canal de distribución para compensación interna","SPART" => "Sector para compensación interna","SPRAS" => "Clave de idioma","WKSOP" => "Centro SOP","AWSLS" => "Clave de desviación","CHAZV_OLD" => "Indicador: Gestión de estado de lote activo","VLFKZ" => "Tipo de centro","BZIRK" => "Zona de ventas","ZONE1" => "Región de suministro","TAXIW" => "Identificador de impuestos centro (Compras)","BZQHL" => "Considerar proveedor regular","LET01" => "Número de días para la primera reclamación","LET02" => "Cantidad de días para la segunda reclamación","LET03" => "Cantidad de días para la tercera reclamación","TXNAM_MA1" => "Nombre del texto 1ª reclamación delcrac.proveedor","TXNAM_MA2" => "Nombres del texto 2ª reclamación de declarac.prove","TXNAM_MA3" => "Nombre del texto 3ª reclamación declarac.proveedor","BETOL" => "Nº de días tolerancia pedido - compactación reg. i","J_1BBRANCH" => "Lugar comercial","VTBFI" => "Regla para determinación del área de ventas p.tras","FPRFW" => "Perfil de distribución a nivel de centro","ACHVM" => "Petición de archivo central p.registro maestro","DVSART" => "Log de lotes: Clase de SGD utilizado","NODETYPE" => "Tipo de nodo de grafo de cadena logística","NSCHEMA" => "Esquema para la formación de nombre","PKOSA" => "Conexión de la contabilidad de objetos de coste ac","MISCH" => "Actualización para el cálculo mixto coste activo","MGVUPD" => "Actualización para el cálculo coste real activa","VSTEL" => "Pto.exped./depto.entrada mcía.","MGVLAUPD" => "Actualización consumo actividad en estructura cuan","MGVLAREVAL" => "Control del abono de centros de coste","SOURCING" => "Acceso a determin.fuente aprovisionamiento mediant","OILIVAL" => "Indicador de valoración de intercambio","OIHVTYPE" => "Clase de proveedores (refinería/fábrica/otros) (Br","OIHCREDIPI" => "Crédito IPI permitido","STORETYPE" => "Tp.tienda p.diferenc.tienda, gran almacén, tienda ","DEP_STORE" => "Grandes almacenes sup.",
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
