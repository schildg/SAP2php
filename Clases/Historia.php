<?php
include_once ("Usuario.php");
include_once('DATA_CONF.php');
class Historia extends MyActiveRecord {
	function buscarId($id) {
		return MyActiveRecord :: FindFirst('Historia', "id = '$id'");
	}
	function leyendaListado($objeto,$id) {
		$obj= MyActiveRecord :: Create($objeto);
		$obj= $obj->buscarId($id);
		return $obj->leyenda();
	}
	function detalleListado($objeto,$campo,$valor) {
		$obj= MyActiveRecord :: Create('Diccionario');
		$obj=$obj->FindFirst('Diccionario', "campo= '$campo' and objeto = '$objeto'");
		$obj1= MyActiveRecord :: Create($obj->objeto_foraneo);
		$obj1= $obj1->buscar($valor);
		return $obj1->leyenda();
	}
	function buscarHistoria($class,$objet) {
		return MyActiveRecord :: FindAll('Historia', "objeto = '$class' AND objeto_id = '$objet'", "id DESC");
	}
	function getUsuario() {
		$user = MyActiveRecord :: FindFirst('Usuario', "id = '$this->usuario_id'");
		return $user->Apellido.", ".$user->Nombre; 
	}
	function nombreCampo($Objeto,$Campo) {
		$obj = MyActiveRecord :: Create($Objeto);
		return $obj->rotulo($Campo); 
	}
	function generarHistoria($strClass,$valOld,$valNew) {
		$arreglo= MyActiveRecord::Columns($strClass);
		$diccionario= MyActiveRecord::Create('Diccionario');
		$diccionario=MyActiveRecord::FindFirst('Diccionario',"objeto = '$strClass' and gene_historia");
		if ($diccionario){
			if ($valOld){
				foreach ($arreglo as $k => $v) {
					$diccionario=MyActiveRecord::FindFirst('Diccionario', "campo= '$k' and objeto = '$strClass' and gene_historia");
					if (trim($valOld->$k)!=trim($valNew->$k) and 
						$k!='date_concurrency' and 
						$this->GetType($strClass,$k)!='blob' and 
						$diccionario and
						$this->GetType($strClass,$k)!='longblob'){
	//						echo "id: ".$valOld->id." ".$k." viejo: ".$valOld->$k." nuevo: ".$valNew->$k."\r\n";
						$usuario=new Usuario();
						$usuario=$usuario->usuario_logueado($usuario->user_sesion());
						$historia = new Historia();
						$historia->fecha = $historia->DbDateTime(time()-3600);
						$historia->usuario_id = $usuario->id;
						$historia->objeto = $strClass;
						$historia->campo = $k;
						$historia->valor_anterior=$valOld->$k;
						$historia->objeto_id = $valOld->id;
						$historia->save();
					}
				}
			}else{
				$usuario=new Usuario();
				$usuario=$usuario->usuario_logueado($usuario->user_sesion());
				$historia = new Historia();
				$historia->fecha = $historia->DbDateTime(time()-3600);
				$historia->usuario_id = $usuario->id;
				$historia->objeto = $strClass;
				$historia->valor_anterior="Alta del registro";
				$historia->objeto_id = $valNew->id;
				$historia->save();
			};
		};
	}
	function borrarHistoria($strClass,$objeto) {
		$historia=new Historia();
		$historias = MyActiveRecord :: FindAll('Historia', "objeto= '$strClass' and objeto_id = '$objeto->id'");
		foreach ($historias as $historia) {
			$historia->destroy();
		}
	}
};
?>
