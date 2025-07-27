<?php /* Smarty version Smarty-3.1.18, created on 2015-09-17 11:21:48
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\ErroresSAP.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57854bfaefb0aad32-19108319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '396a35253c918eab4b3323550053cf7c8b7b8a74' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\ErroresSAP.tpl',
      1 => 1442499635,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57854bfaefb0aad32-19108319',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54bfaefb36bba6_96157954',
  'variables' => 
  array (
    'exportarPlanCal' => 0,
    'self' => 0,
    'estado' => 0,
    'est' => 0,
    'fecha_1' => 0,
    'fecha_2' => 0,
    'consulta' => 0,
    'cons' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bfaefb36bba6_96157954')) {function content_54bfaefb36bba6_96157954($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\modifier.regex_replace.php';
if (!is_callable('smarty_modifier_date_format')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_dhtml_calendar')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\function.dhtml_calendar.php';
?>
 <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>
<table summary=" Monitor de Errores arrojados por SAP  " border="0">
	<tbody>
		<td>
		<h1> Monitor de Errores arrojados por SAP  </h1>
		</td>
		<td>
		<div id="contab-herramienta"> <a
			href="<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['self']->value,"
			/index.php/",'');?>
manExort.php?accion=generarReporteErrores " TARGET='_blank'><img
			class="iconos" src="css-imgs/planCal.png" alt="Exportar el listado"
			title="Exportar el listado" />Exportar el listado</a></div>
		</td>
	</tbody>
</table>
<?php } else { ?>
<h1> Monitor de Errores arrojados por SAP  </h1>
<?php }?>

<hr>
<div class="lista">
<table summary="Estado de las OF's">
	<tbody>
		<tr>
		<?php  $_smarty_tpl->tpl_vars['est'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['est']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['estado']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['est']->key => $_smarty_tpl->tpl_vars['est']->value) {
$_smarty_tpl->tpl_vars['est']->_loop = true;
?>
			<th><?php echo $_smarty_tpl->tpl_vars['est']->value["estado"];?>
</th>
			<td><?php echo $_smarty_tpl->tpl_vars['est']->value["cuenta"];?>
</td>
		<?php } ?>
		</tr>
	</tbody>
</table>
</div>
<hr>

<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post">
   <table summary="Datos de FILTRO de HF's" border="0" >
    <tbody>
	  <tr>
	    <th>Fecha de inicio</th>
	     <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>
		<td><input  tabindex="1" type="text" id="fecha_1" name="fecha_1" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['fecha_1']->value,"%d/%m/%Y");?>
" />
						  <a href="" id="trigger_fecha_1" ><img class="calendario" src="css-imgs/cal.png" alt="Ver Calendario" title="Ver Calendario"/></a>
		                  <?php echo smarty_function_dhtml_calendar(array('inputField'=>'fecha_1','button'=>"trigger_fecha_1",'singleClick'=>true),$_smarty_tpl);?>

		</td>
		<?php } else { ?><td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['fecha_1']->value,"%d/%m/%Y");?>
</td>
		<?php }?>
		</tr><tr>
	    <th>Fecha de finalizacion</th>
	     <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>	    
		<td><input  tabindex="1" type="text" id="fecha_2" name="fecha_2" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['fecha_2']->value,"%d/%m/%Y");?>
" />
						  <a href="" id="trigger_fecha_2" ><img class="calendario" src="css-imgs/cal.png" alt="Ver Calendario" title="Ver Calendario"/></a>
		                  <?php echo smarty_function_dhtml_calendar(array('inputField'=>'fecha_2','button'=>"trigger_fecha_2",'singleClick'=>true),$_smarty_tpl);?>

		</td>
		<?php } else { ?><td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['fecha_2']->value,"%d/%m/%Y");?>
</td>
		<?php }?>
	  </tr>
	  <tr>
	  			<th><input value="Generar" tabindex="1" type="submit" /> 
				<input type="hidden" name="accion" value="generarReporteErrores" /></th>
	  </tr>
	</tbody></table>
 </form>
 
<hr>
<h2>Existen <?php echo count($_smarty_tpl->tpl_vars['consulta']->value);?>
 Errores</h2> 
<div class="lista">
<table class="lista" summary="Monitor de Errores" border="0">
	<tbody>
		<tr>
   		 <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>
			<th title="Declarado en SAP">Declarado en SAP<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=declarado_en_sap&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=declarado_en_sap&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Estado">Estado<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=estado&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=estado&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Accion">Accion</th>
			<th title="Tarea">Tarea<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=nmov_lt&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=nmov_lt&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="UT">UT<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=utor_lt&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=utor_lt&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Codigo">Codigo<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=codigo&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=codigo&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Numero">Numero<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=numero&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=numero&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="OF SAP">OF SAP<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=numero_sap&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=numero_sap&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Cantidad">Cantidad<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=cant_lt&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=cant_lt&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Fecha HF">Fecha HF<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=fech_sd&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=fech_sd&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Id obejto sap">Id obejto sap<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=id_objeto_sap&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=id_objeto_sap&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="RFC">RFC<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=rfc&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=rfc&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Tipo">Tipo<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=type&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=type&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Nro Error">Nro Error<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=number&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=number&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Mensaje">Mensaje<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=message&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=message&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Material">Material<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=matnr&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=matnr&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="Lote">Lote<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=charg&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=charg&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
			<th title="HU">HU<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=exidv_ob&amp;orden=DESC"><img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc" title="Ordenar Descendente" /> </a><a
                                            				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=generarReporteErrores&amp;campoorden=exidv_ob&amp;orden=ASC"><img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc" title="Ordenar Ascendente" /> </a></th>
   		<?php } else { ?>
			<th title="Declarado en SAP">Declarado en SAP</th>
			<th title="Estado">Estado</th>
			<th title="Accion">Accion</th>
			<th title="Tarea">Tarea</th>
			<th title="UT">UT</th>
			<th title="Codigo">Codigo</th>
			<th title="Numero">Numero</th>
			<th title="OF SAP">OF SAP</th>
			<th title="Cantidad">Cantidad</th>
			<th title="Fecha HF">Fecha HF</th>
			<th title="Id obejto sap">Id obejto sap</th>
			<th title="RFC">RFC</th>
			<th title="Tipo">Tipo</th>
			<th title="Nro Error">Nro Error</th>
			<th title="Mensaje">Mensaje</th>
			<th title="Material">Material</th>
			<th title="Lote">Lote</th>
			<th title="HU">HU</th>
		<?php }?> 
			<th colspan="1"></th>
			
		</tr>
		<?php  $_smarty_tpl->tpl_vars['cons'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cons']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['consulta']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cons']->key => $_smarty_tpl->tpl_vars['cons']->value) {
$_smarty_tpl->tpl_vars['cons']->_loop = true;
?>
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["declarado_en_sap"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["estado"];?>
</td>
			<td nowrap>
	   		 <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>
				<?php if ($_smarty_tpl->tpl_vars['cons']->value["estado"]=="CSx") {?>
						<div><a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id_tarea=<?php echo $_smarty_tpl->tpl_vars['cons']->value["nmov_lt"];?>
&amp;accion=generarReporteErrores&amp;SubAction=PasarParticionar&amp;id_of_sap=<?php echo $_smarty_tpl->tpl_vars['cons']->value["numero_sap"];?>
"><img
						 height=32px src="css-imgs/letra_p.png" alt="mandar a particionar"
						title="mandar a particionar" /></a>
						<a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id_tarea=<?php echo $_smarty_tpl->tpl_vars['cons']->value["nmov_lt"];?>
&amp;accion=generarReporteErrores&amp;SubAction=AConsumir&amp;id_of_sap=<?php echo $_smarty_tpl->tpl_vars['cons']->value["numero_sap"];?>
"><img
						 height=32px src="css-imgs/letra_c.png" alt="mandar a consumir"
						title="mandar a consumir" /></a></div>
	            <?php } else { ?>
					<?php if ($_smarty_tpl->tpl_vars['cons']->value["estado"]=="PAx") {?>
						<div><a href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id_tarea=<?php echo $_smarty_tpl->tpl_vars['cons']->value["nmov_lt"];?>
&amp;accion=generarReporteErrores&amp;SubAction=AParticionar&amp;id_of_sap=<?php echo $_smarty_tpl->tpl_vars['cons']->value["numero_sap"];?>
"><img
						 height=32px src="css-imgs/letra_p.png" alt="mandar a particionar"
						title="mandar a particionar" /></a>
		            <?php }?>			 	
	            <?php }?>			 	
            <?php }?>			 	
			</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["nmov_lt"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["utor_lt"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["codigo"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["numero"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["numero_sap"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["cant_lt"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["fech_sd"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["id_objeto_sap"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["rfc"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["type"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["number"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["message"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["matnr"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["charg"];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value["exidv_ob"];?>
</td>
			<td width="1%"><a
	   		 <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id_tarea=<?php echo $_smarty_tpl->tpl_vars['cons']->value["nmov_lt"];?>
&amp;accion=detalleErrorSAP"><img
				class="ordenar" src="css-imgs/editar.png" alt="Detalles del Error SAP"
				title="Detalles del Error SAP" /></a>
			 <?php }?>
			</td>

		</tr>
		<?php } ?>
	</tbody>
</table>
</div>

 <?php }} ?>
