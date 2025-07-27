<?php /* Smarty version Smarty-3.1.18, created on 2015-03-19 16:18:04
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\ListadorDeDatos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14761549861139f0342-79332502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64e47cae3a6da6e7dbaa89dc1fe336a328ab09df' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\ListadorDeDatos.tpl',
      1 => 1426529020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14761549861139f0342-79332502',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54986113b3b571_37655587',
  'variables' => 
  array (
    'titulo' => 0,
    'columna' => 0,
    'exportarPlanCal' => 0,
    'k' => 0,
    'objeto' => 0,
    'self' => 0,
    'tipoListado' => 0,
    'SUBOBJETO' => 0,
    'listaObjetos' => 0,
    'obj' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54986113b3b571_37655587')) {function content_54986113b3b571_37655587($_smarty_tpl) {?><div class="lista">
<table class="lista" summary="<?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
" border="0">
	<tbody>
		<tr>
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columna']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>
			<th title="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['objeto']->value->rotulo($_smarty_tpl->tpl_vars['k']->value);?>
<a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=<?php echo $_smarty_tpl->tpl_vars['tipoListado']->value;?>
<?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
&amp;campoorden=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
&amp;orden=DESC">
			<img class="ordenar" src="css-imgs/abajo.png" alt="Ord Asc"
				title="Ordenar Descendente" /> </a><a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?accion=<?php echo $_smarty_tpl->tpl_vars['tipoListado']->value;?>
<?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
&amp;campoorden=<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
&amp;orden=ASC">
			<img class="ordenar" src="css-imgs/arriba.png" alt="Ord Desc"
				title="Ordenar Ascendente" /> </a></th>
			<?php } else { ?>
			<th><?php echo $_smarty_tpl->tpl_vars['objeto']->value->rotulo($_smarty_tpl->tpl_vars['k']->value);?>
</th>
			<?php }?> <?php } ?>
			<th colspan="2"></th>
		</tr>
		<?php  $_smarty_tpl->tpl_vars['obj'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['obj']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listaObjetos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['obj']->key => $_smarty_tpl->tpl_vars['obj']->value) {
$_smarty_tpl->tpl_vars['obj']->_loop = true;
?>
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<?php echo $_smarty_tpl->getSubTemplate ("tipo-dato-listador.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
 <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>
			<td width="2%"><a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id=<?php echo $_smarty_tpl->tpl_vars['obj']->value->id;?>
&amp;accion=editar<?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
&amp;subaccion=editar"><img
				class="ordenar" src="css-imgs/editar.png" alt="Editar <?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
"
				title="Editar <?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
" /></a></td>
			<td width="2%"><a
				href="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
?id=<?php echo $_smarty_tpl->tpl_vars['obj']->value->id;?>
&amp;accion=editar<?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
&amp;subaccion=borrar"><img
				class="ordenar" src="css-imgs/borrar.png"
				alt="Eliminar <?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
" title="Eliminar <?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
" /></a></td>
			<?php }?>
		</tr>
		<?php } ?>

	</tbody>
</table>
</div>


<?php }} ?>
