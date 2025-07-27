<?php /* Smarty version Smarty-3.1.18, created on 2015-03-19 16:17:56
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\cabeceraListado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2121854986111e40800-09623138%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0202f14bc46df32fda369f2d929339c5b11484b7' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\cabeceraListado.tpl',
      1 => 1426529019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2121854986111e40800-09623138',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_549861124e9628_15300430',
  'variables' => 
  array (
    'exportarPlanCal' => 0,
    'titulo' => 0,
    'tipoListado' => 0,
    'self' => 0,
    'OBJETO' => 0,
    'Accion' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_549861124e9628_15300430')) {function content_549861124e9628_15300430($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\modifier.regex_replace.php';
?> <?php if (!$_smarty_tpl->tpl_vars['exportarPlanCal']->value) {?>
<table summary="<?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
" border="0">
	<tbody>
		<td>
		<h2><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h2>
		</td>
		<td>
		<div id="contab-herramienta"><?php if ($_smarty_tpl->tpl_vars['tipoListado']->value=='filtro') {?> <a
			href="<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['self']->value,"
			/index.php/",'');?>
manPDF.php?accion=<?php echo $_smarty_tpl->tpl_vars['OBJETO']->value;?>
PDF " TARGET='_blank'><img
			class="iconos" src="css-imgs/pdf.png" alt="Generar PDF del listado"
			title="Generar PDF del listado" />Generar PDF del listado</a> <?php }?> <a
			href="<?php echo smarty_modifier_regex_replace($_smarty_tpl->tpl_vars['self']->value,"
			/index.php/",'');?>
manExort.php?accion=<?php echo $_smarty_tpl->tpl_vars['Accion']->value;?>
 " TARGET='_blank'><img
			class="iconos" src="css-imgs/planCal.png" alt="Exportar el listado"
			title="Exportar el listado" />Exportar el listado</a></div>
		</td>
	</tbody>
</table>
<?php } else { ?>
<h2><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h2>
<?php }?>


<?php }} ?>
