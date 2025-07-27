<?php
include_once('DATA_CONF.php');
class Menu extends SuperClase {
	function Menu() {
		$this->CLASE_OBJETO='Menu';
	}
	function leyenda() {
		return $this->denominacion;
	}
	function rotulo($campo) {
		$Campo=array("id" => "id",
                     "denominacion" => "Denominacion",
                     "habilitado" => "Habilitado",
                     "tipo_menu" => "Tipo de relacion",
                     );
        return $Campo[$campo];
	}
	function crearMenues($i){
		$menu_menu = new Menu_Menu();
		$submenues = $menu_menu->buscarSubmenu($this->id);
		foreach( $submenues as $menu_menu){
			$menu = new Menu();
			$menu=$menu->buscarId($menu_menu->menu_id1);
			if ($menu->habilitado){
				$i++;
				$linea[$i] ='<li><a href="javascript:void(0);" childid = "c_'.$menu_menu->menu_id.'_'.$menu_menu->menu_id1.'" class="cat_close category">'.$menu->denominacion.'</a></li>'."\n";
		 	    echo $linea[$i];
				$i++;
				$linea[$i] ='<ul id=c_'.$menu_menu->menu_id.'_'.$menu_menu->menu_id1.'>';
				echo $linea[$i];
				$menu->crearMenues($i);
			    $i++;
			    $menu=$menu->buscarId($menu_menu->menu_id1);			
			}
		}

		 $accion_menu = new Accion_Menu();
		 $acciones = $accion_menu->buscarAcciones($this->id);
		 $aCcion = new Accion();
		 foreach( $acciones as $accion_menu){
		     $i++;
		     $aCcion=$aCcion->buscarId($accion_menu->accion_id);
		     if ($aCcion->habilitado){
				 $linea[$i] ='<li><a href="'.$self.'?accion='.$aCcion->comando.'" class="product">'.$aCcion->rotulo.'</a></li>'."\n";			
	 	         echo $linea[$i];
		     }
		 }
		$linea[$i]='</ul>';
 	    echo $linea[$i];
	}
};
?>
