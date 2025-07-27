<?php /* Smarty version Smarty-3.1.18, created on 2018-03-14 09:09:09
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\monitor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10375549856cc986cd8-00888886%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b427db40c2433aa1a508260ac3e70b4cdc8689a' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\monitor.tpl',
      1 => 1521029346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10375549856cc986cd8-00888886',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_549856ccac9a44_43994328',
  'variables' => 
  array (
    'self' => 0,
    'servicios' => 0,
    'srv' => 0,
    'alf' => 0,
    'SUBOBJETO' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549856ccac9a44_43994328')) {function content_549856ccac9a44_43994328($_smarty_tpl) {?><h1>Monitor de Servicios</h1>



<br />
<a	href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=monitor"><img
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
		<?php  $_smarty_tpl->tpl_vars['srv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['srv']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['servicios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['srv']->key => $_smarty_tpl->tpl_vars['srv']->value) {
$_smarty_tpl->tpl_vars['srv']->_loop = true;
?>
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td><?php echo $_smarty_tpl->tpl_vars['srv']->value->nombre_servicio;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['srv']->value->estado;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['srv']->value->subestado;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['srv']->value->secuencia;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['srv']->value->paquete;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['srv']->value->mensaje;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['srv']->value->pid;?>
</td>
			<td>
			 <?php  $_smarty_tpl->tpl_vars['alf'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['alf']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['srv']->value->get_alfabeto(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['alf']->key => $_smarty_tpl->tpl_vars['alf']->value) {
$_smarty_tpl->tpl_vars['alf']->_loop = true;
?>
			   <?php if (!($_smarty_tpl->tpl_vars['srv']->value->nombre_servicio=="consumossSAP")) {?>
			 	<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post">
			 		<input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['alf']->value;?>
" /> 
			 		<input type="hidden" name="accion" value="monitor" /> 
			 		<input type="hidden" name="ServiceAction" value="<?php echo $_smarty_tpl->tpl_vars['alf']->value;?>
" />
			 		<input type="hidden" name="services" value="<?php echo $_smarty_tpl->tpl_vars['srv']->value->nombre_servicio;?>
" />
			 	</form>
			 	<?php }?>
			 <?php } ?>
			</td>
			<td width="1%"><a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id=<?php echo $_smarty_tpl->tpl_vars['srv']->value->id;?>
&amp;accion=editar<?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
&amp;subaccion=editar"><img
				class="ordenar" src="css-imgs/editar.png" alt="Editar <?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
"
				title="Editar <?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
" /></a>
			</td>

		</tr>
		<?php } ?>
	</tbody>
</table>
</div>

<?php }} ?>
