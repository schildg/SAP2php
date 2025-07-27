
<form action="{$self}" method="post">
<fieldset><legend align="center">Cambio de Password</legend>
<table class="campo-amb" summary="Cambio de Password" border="0"
	align="center">
	<tbody>
		<tr>
			<th>Usuario:</th>
			<th><input name="user" tabindex="1" type="text"
				value="{$usuario->login}" disabled="disabled" /></th>
			<th rowspan="4"><img width="128px" height="128px"
				src="css-imgs/locked.png" alt="Cambiar Password" /></th>
		</tr>
		<tr>
			<th>Password Anterior:</th>
			<th><input type="password" name="passAnt" value="" tabindex="2" /></th>
		</tr>
		<tr>
			<th>Password Nuevo:</th>
			<th><input type="password" name="pass1" value="" tabindex="3" /></th>
		</tr>
		<tr>
			<th>Confirme el Password:</th>
			<th><input type="password" name="pass2" value="" tabindex="4" /></th>
		</tr>
		<tr>
			<th><input type="submit" value="Enviar" /><input type="hidden"
				name="accion" value="cambiarPassword" /></th>
		</tr>
	</tbody>
</table>
</fieldset>
</form>
