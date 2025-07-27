<?php /* Smarty version Smarty-3.1.18, created on 2014-08-26 09:40:27
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\FiltradorDeDatos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2323053fc803b405f41-09129954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd86feee2b352cbdacf5bcc4da744c32cd386d114' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\FiltradorDeDatos.tpl',
      1 => 1403708930,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2323053fc803b405f41-09129954',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'exportarPlanCal' => 0,
    'self' => 0,
    'OBJETO' => 0,
    'titulo' => 0,
    'SUBOBJETO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53fc803b441f80_37723472',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fc803b441f80_37723472')) {function content_53fc803b441f80_37723472($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>

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
