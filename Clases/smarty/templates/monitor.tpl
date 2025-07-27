<h1>Monitor de Servicios</h1>



<br />
<a	href="{$self}?accion=monitor"><img
	class="iconos" src="css-imgs/refresh.png" alt="Refresh"
	title="Refresh" />
</a>

<div class="lista">
<table class="lista" summary="Monitor de Servicios" border="0">
	<tbody>
		<tr>
			<th>Servicio</th>
			<th>Estado</th>
			<th>SubEstado</th>
			<th>Secuencia</th>
			<th>Paquete</th>
			<th>Mensaje de Error</th>
			<th>PID</th>
			<th>Accion</th>
			<th colspan="1"></th>
			
		</tr>
		{foreach from=$servicios item=srv}
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td>{$srv->nombre_servicio}</td>
			<td>{$srv->estado}</td>
			<td>{$srv->subestado}</td>
			<td>{$srv->secuencia}</td>
			<td>{$srv->paquete}</td>
			<td>{$srv->mensaje}</td>
			<td>{$srv->pid}</td>
			<td>
			 {foreach from=$srv->get_alfabeto() item=alf}
			   {if !($srv->nombre_servicio=="consumossSAP")}
			 	<form action="{$self}" method="post">
			 		<input type="submit" value="{$alf}" /> 
			 		<input type="hidden" name="accion" value="monitor" /> 
			 		<input type="hidden" name="ServiceAction" value="{$alf}" />
			 		<input type="hidden" name="services" value="{$srv->nombre_servicio}" />
			 	</form>
			 	{/if}
			 {/foreach}
			</td>
			<td width="1%"><a
				href="{$self}?id={$srv->id}&amp;accion=editar{$SUBOBJETO}&amp;subaccion=editar"><img
				class="ordenar" src="css-imgs/editar.png" alt="Editar {$SUBOBJETO}"
				title="Editar {$SUBOBJETO}" /></a>
			</td>

		</tr>
		{/foreach}
	</tbody>
</table>
</div>

