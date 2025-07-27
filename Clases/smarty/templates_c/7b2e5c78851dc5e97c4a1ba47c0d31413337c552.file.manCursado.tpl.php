<?php /* Smarty version Smarty-3.1.18, created on 2015-01-21 11:39:13
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\manCursado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:258554bf92a5c89af9-03808940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b2e5c78851dc5e97c4a1ba47c0d31413337c552' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\manCursado.tpl',
      1 => 1421847548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258554bf92a5c89af9-03808940',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54bf92a626c9b3_34558864',
  'variables' => 
  array (
    'self' => 0,
    'fecha_1' => 0,
    'fecha_2' => 0,
    'consulta' => 0,
    'cons' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bf92a626c9b3_34558864')) {function content_54bf92a626c9b3_34558864($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_dhtml_calendar')) include 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\plugins\\function.dhtml_calendar.php';
?><h1> Monitor de Errores arojados por SAP  </h1>
<hr>

<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post">
   <table summary="Datos de FILTRO de HF's" border="0" >
    <tbody>
	  <tr>
	    <th>Fecha de inicio</th>
		<td><input  tabindex="1" type="text" id="fecha_1" name="fecha_1" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['fecha_1']->value,"%d/%m/%Y");?>
" />
						  <a href="" id="trigger_fecha_1" ><img class="calendario" src="css-imgs/cal.png" alt="Ver Calendario" title="Ver Calendario"/></a>
		                  <?php echo smarty_function_dhtml_calendar(array('inputField'=>'fecha_1','button'=>"trigger_fecha_1",'singleClick'=>true),$_smarty_tpl);?>

		</td>
		</tr><tr>
	    <th>Fecha de finalizacion</th>
		<td><input  tabindex="1" type="text" id="fecha_2" name="fecha_2" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['fecha_2']->value,"%d/%m/%Y");?>
" />
						  <a href="" id="trigger_fecha_2" ><img class="calendario" src="css-imgs/cal.png" alt="Ver Calendario" title="Ver Calendario"/></a>
		                  <?php echo smarty_function_dhtml_calendar(array('inputField'=>'fecha_2','button'=>"trigger_fecha_2",'singleClick'=>true),$_smarty_tpl);?>

		</td>
	  </tr>
	  <tr>
	  			<th><input value="Generar" tabindex="1" type="submit" /> 
				<input type="hidden" name="accion" value="generarReporteErrores" /></th>
	  </tr>
	</tbody></table>
 </form>
 
 
<div class="lista">
<table class="lista" summary="Monitor de Errores" border="0">
	<tbody>
		<tr>
			<th>Declarado en SAP</th>
			<th>Estado</th>
			<th>Tarea</th>
			<th>Codigo</th>
			<th>Numero</th>
			<th>OF SAP</th>
			<th>Cantidad</th>
			<th>Fecha HF</th>
			<th colspan="1"></th>
			
		</tr>
		<?php  $_smarty_tpl->tpl_vars['cons'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cons']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['consulta']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cons']->key => $_smarty_tpl->tpl_vars['cons']->value) {
$_smarty_tpl->tpl_vars['cons']->_loop = true;
?>
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value->declarado_en_sap;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value->estado;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value->nmov_lt;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value->codigo;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value->numero;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value->numero_sap;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value->cant_lt;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['cons']->value->fech_sd;?>
</td>

		</tr>
		<?php } ?>
	</tbody>
</table>
</div>

 <?php }} ?>
