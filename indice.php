<?php
include_once ("funciones.php");
if (isset ($_POST['accion'])) {
	$accion = $_POST['accion'];
} else {
	$accion = $_GET['accion'];
}

include_once ("Clases/Permiso.php");
$permiso = new Permiso();
if(isset($_SESSION["usuario"])){
	if($permiso->autorizado($accion)){
		$exportarPlanCal=false;
		include_once ("Clases/Accion.php");
		$comando = new Accion();
		include($comando->modulo($accion));
	}else{if ($accion!="login" and $accion!="verSubMenu" and $accion!=""){
		?>
				<form action="<?php echo($self); ?>" method="post">
				   <table summary="informacion de sesion" border="0"   align="center">
				    <tbody>
					    <tr>
					      <th><img 	src="css-imgs/error.png"/> 
					      </th>
					      <th><h1>   Disculpe, pero Usd. no puede ejecutar este modulo!</h1> 
					      </th>
					    </tr>
					    <tr><th></th><th><h2>   consulte informacion del comando <?php echo($accion); ?></h2></th></tr> 
					</tbody></table>
				 </form>
		<?php
		}
	}
}else{
	if ($accion=='close' or $accion=='loguear' or $accion==''){
	?>
			<form action="<?php echo($self); ?>" method="post">
                           <legend align= "center" />Informaci&#243;n del Usuario<legend/>
                           <fieldset>
			   <table summary="LOGIN" border="0"   align="center">
			    <tbody>
				    <tr>
				      <th>Usuario: 
				      </th>
				      <th><input name="user" tabindex="1" type="text" value=""/>
				      </th>
				      <th rowspan="4"><img 	width="128px" height="128px" src="css-imgs/user.png" alt="Ingrese su datos "/></th>
				    </tr>
				    <tr>
				      <th>Password: 
				      </th>
				      <th><input type="password" name="pass" value="" tabindex="2"/>
				      </th>
				    </tr>
				    <tr>
				      <th><input type="submit" value="Enviar"/><input type="hidden" name="accion" value="login"/> 
				      </th>
				    </tr>
				</tbody></table>
                           </fieldset>
			 </form>
	<?php
	}else{
			?>
			<form action="<?php echo($self); ?>" method="post">
			   <table summary="informacion de sesion" border="0"   align="center">
			    <tbody>
				    <tr>
				      <th><img 	src="css-imgs/error.png"/> 
				      </th>
				      <th><h1>   Ha caducado el tiempo de la Sesion!</h1> 
				      </th>
				    </tr>
				</tbody></table>
			 </form>
	<?php
		
		
	}
}
?>