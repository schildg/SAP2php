<h1>Administrador de Permisos</h1>
<form action="{$self}" method="post">
<table summary="Administrador de Permisos" border="0">
	<tbody>
		<tr>
			<th>
			<h2>Seleccione un Usuario</h2>
			</th>
			<th><select name="usuario-id" tabindex="1">
				{if $usuario->id == 0}
				<option label="-- NADA --" selected="selected" value="0">-- NADA --</option>
				{else}
				<option label="-- NADA --" value="0">-- NADA --</option>
				{/if} {foreach from=$relacion->FindAll('Usuario') item=usua} {if
				$usuario->id == $usua->id}
				<option label="{$usua->leyenda()}" selected="selected"
					value="{$usua->id}">{$usua->leyenda()}</option>
				{else}
				<option label="{$usua->leyenda()}" value="{$usua->id}">{$usua->leyenda()}</option>
				{/if} {/foreach}
			</select>
			<th><input value="Ver" tabindex="1" type="submit" /> <input
				type="hidden" name="accion" value="manPermisos" /></th>
			<tr>
			</tr>
	
	</tbody>
</table>

</form>



{if $usuario->id}
<hr>
<h2>Permisos del Usuario</h2>
<br />
<div class="lista">
<table class="lista" summary="Permisos del Usuario" border="0">
	<tbody>
		<tr>
			<th>Modulo</th>
			<th>Accion</th>
			<th>Permiso</th>
		</tr>
		{foreach from=$acciones item=obj}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td>{$obj->modulo}</td>
			<td>{$obj->comando}</td>
			<td>{if !$permiso->usuarioAutorizado($obj->comando,$usuario->id)}
			<form action="{$self}" method="post"><input type="submit"
				value="Habilitar" /> <input type="hidden" name="accion"
				value="manPermisos-Hab" /> <input type="hidden" name="usuario-id"
				value="{$usuario->id}" /> <input type="hidden" name="accion-id"
				value="{$obj->id}" /></form>
			{else}
			<form action="{$self}" method="post"><input type="submit"
				value="Deshabilitar" /> <input type="hidden" name="accion"
				value="manPermisos-DesHab" /> <input type="hidden" name="usuario-id"
				value="{$usuario->id}" /> <input type="hidden" name="accion-id"
				value="{$obj->id}" /></form>
			{/if}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</div>

{/if}
