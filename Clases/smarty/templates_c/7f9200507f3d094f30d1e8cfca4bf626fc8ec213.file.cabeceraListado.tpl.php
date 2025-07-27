<?php /* Smarty version Smarty-3.1.18, created on 2014-08-26 09:40:27
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\cabeceraListado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2392953fc803b2e2887-74325199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f9200507f3d094f30d1e8cfca4bf626fc8ec213' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\cabeceraListado.tpl',
      1 => 1403708930,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2392953fc803b2e2887-74325199',
  'function' => 
  array (
  ),
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
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53fc803b3df3d8_12610483',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fc803b3df3d8_12610483')) {function content_53fc803b3df3d8_12610483($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_regex_replace')) include 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\plugins\\modifier.regex_replace.php';
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
