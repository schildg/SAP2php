<?php /* Smarty version Smarty-3.1.18, created on 2015-01-21 09:42:10
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\manPermisos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1897754bf90922f4916-53576600%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94e930bb2bf652acf84fa979b7a0ff77349b59a4' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\manPermisos.tpl',
      1 => 1406893482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1897754bf90922f4916-53576600',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'self' => 0,
    'usuario' => 0,
    'relacion' => 0,
    'usua' => 0,
    'acciones' => 0,
    'obj' => 0,
    'permiso' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54bf9092716b81_17983215',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54bf9092716b81_17983215')) {function content_54bf9092716b81_17983215($_smarty_tpl) {?><h1>Administrador de Permisos</h1>
<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post">
<table summary="Administrador de Permisos" border="0">
	<tbody>
		<tr>
			<th>
			<h2>Seleccione un Usuario</h2>
			</th>
			<th><select name="usuario-id" tabindex="1">
				<?php if ($_smarty_tpl->tpl_vars['usuario']->value->id==0) {?>
				<option label="-- NADA --" selected="selected" value="0">-- NADA --</option>
				<?php } else { ?>
				<option label="-- NADA --" value="0">-- NADA --</option>
				<?php }?> <?php  $_smarty_tpl->tpl_vars['usua'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['usua']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relacion']->value->FindAll('Usuario'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['usua']->key => $_smarty_tpl->tpl_vars['usua']->value) {
$_smarty_tpl->tpl_vars['usua']->_loop = true;
?> <?php if ($_smarty_tpl->tpl_vars['usuario']->value->id==$_smarty_tpl->tpl_vars['usua']->value->id) {?>
				<option label="<?php echo $_smarty_tpl->tpl_vars['usua']->value->leyenda();?>
" selected="selected"
					value="<?php echo $_smarty_tpl->tpl_vars['usua']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['usua']->value->leyenda();?>
</option>
				<?php } else { ?>
				<option label="<?php echo $_smarty_tpl->tpl_vars['usua']->value->leyenda();?>
" value="<?php echo $_smarty_tpl->tpl_vars['usua']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['usua']->value->leyenda();?>
</option>
				<?php }?> <?php } ?>
			</select>
			<th><input value="Ver" tabindex="1" type="submit" /> <input
				type="hidden" name="accion" value="manPermisos" /></th>
			<tr>
			</tr>
	
	</tbody>
</table>

</form>



<?php if ($_smarty_tpl->tpl_vars['usuario']->value->id) {?>
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
		<?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['acciones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td><?php echo $_smarty_tpl->tpl_vars['obj']->value->modulo;?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['obj']->value->comando;?>
</td>
			<td><?php if (!$_smarty_tpl->tpl_vars['permiso']->value->usuarioAutorizado($_smarty_tpl->tpl_vars['obj']->value->comando,$_smarty_tpl->tpl_vars['usuario']->value->id)) {?>
			<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post"><input type="submit"
				value="Habilitar" /> <input type="hidden" name="accion"
				value="manPermisos-Hab" /> <input type="hidden" name="usuario-id"
				value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->id;?>
" /> <input type="hidden" name="accion-id"
				value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->id;?>
" /></form>
			<?php } else { ?>
			<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post"><input type="submit"
				value="Deshabilitar" /> <input type="hidden" name="accion"
				value="manPermisos-DesHab" /> <input type="hidden" name="usuario-id"
				value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->id;?>
" /> <input type="hidden" name="accion-id"
				value="<?php echo $_smarty_tpl->tpl_vars['obj']->value->id;?>
" /></form>
			<?php }?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>

<?php }?>
<?php }} ?>
