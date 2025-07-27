<?php /* Smarty version Smarty-3.1.18, created on 2015-03-19 16:17:56
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\FiltradorDeDatos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2213154986112571f26-88498520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fc42f5e7f136433c399fe65d6fd7acc2dd29c3d' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\FiltradorDeDatos.tpl',
      1 => 1426529020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2213154986112571f26-88498520',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54986112625c52_94907709',
  'variables' => 
  array (
    'exportarPlanCal' => 0,
    'self' => 0,
    'OBJETO' => 0,
    'titulo' => 0,
    'SUBOBJETO' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54986112625c52_94907709')) {function content_54986112625c52_94907709($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>

<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post">
<fieldset><legend>Informaci&#243;n de la relacion <?php echo $_smarty_tpl->tpl_vars['OBJETO']->value;?>
</legend>
<table class="campo-amb" summary="<?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
" border="0">
	<tbody>
		<?php echo $_smarty_tpl->getSubTemplate ("tipo-dato-filtro.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</tbody>
</table>
</fieldset>
<p></p>
<input value="Buscar" tabindex="1" type="submit" />
<p></p>
<input type="hidden" name="accion" value="filtro<?php echo $_smarty_tpl->tpl_vars['SUBOBJETO']->value;?>
" /></form>
<?php }?>
<?php }} ?>
