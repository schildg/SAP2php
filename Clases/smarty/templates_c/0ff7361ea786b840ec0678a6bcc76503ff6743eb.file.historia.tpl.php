<?php /* Smarty version Smarty-3.1.18, created on 2014-08-28 08:30:15
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\historia.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2678353ff12c723c8f3-95861651%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ff7361ea786b840ec0678a6bcc76503ff6743eb' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\historia.tpl',
      1 => 1403996245,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2678353ff12c723c8f3-95861651',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'listaHistoria' => 0,
    'historia' => 0,
    'OBJETO' => 0,
    'objeto' => 0,
    'tabla' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53ff12c759fd15_51997277',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ff12c759fd15_51997277')) {function content_53ff12c759fd15_51997277($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\plugins\\modifier.date_format.php';
?>
<h2>Historial de los Movimientos</h2>
<div class="lista">
<table class="lista" summary="Listado de historial de movimientos"
	border="0">
	<tbody>
		<tr>
			<th>Usuario que modifico</th>
			<th>Campo</th>
			<th>Valor Anterior</th>
			<th>Fecha y Hora de Modificacion</th>

			<?php  $_smarty_tpl->tpl_vars['historia'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['historia']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listaHistoria']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['historia']->key => $_smarty_tpl->tpl_vars['historia']->value) {
$_smarty_tpl->tpl_vars['historia']->_loop = true;
?>
			<tr onmouseout="this.bgColor='Linen'"
				onmouseover="this.bgColor='Coral'">
				<td><?php echo $_smarty_tpl->tpl_vars['historia']->value->getUsuario();?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['historia']->value->nombreCampo($_smarty_tpl->tpl_vars['historia']->value->objeto,$_smarty_tpl->tpl_vars['historia']->value->campo);?>
</td>
				<td><?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['historia']->value->campo)=="tinyint") {?> <?php if ($_smarty_tpl->tpl_vars['historia']->value->valor_anterior==1) {?> SI <?php } else { ?> NO <?php }?> <?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['historia']->value->campo)=="char") {?>
				<?php echo $_smarty_tpl->tpl_vars['tabla']->value->campo($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['historia']->value->campo,$_smarty_tpl->tpl_vars['historia']->value->valor_anterior);?>

				<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['historia']->value->campo)=="date") {?>
				<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['historia']->value->valor_anterior,"%d/%m/%Y");?>
 <?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->esForaneo($_smarty_tpl->tpl_vars['historia']->value->campo)) {?> {
				$historia->detalleListado($OBJETO,$historia->campo,$historia->valor_anterior)
				} <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['historia']->value->valor_anterior;?>
 <?php }?> <?php }?> <?php }?> <?php }?></td>
				<td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['historia']->value->fecha,"%d/%m/%Y %H:%M:%S");?>
</td>
			</tr>
			<?php } ?>
	
	</tbody>
</table>
</div>


<?php }} ?>
