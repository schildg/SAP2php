<?php /* Smarty version Smarty-3.1.18, created on 2015-03-16 15:59:01
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\tipo-dato-amb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190555499511a3b5ec9-49546757%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a73384f2a540bb50741f180714bc0f3a1f8d940' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\tipo-dato-amb.tpl',
      1 => 1426529020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190555499511a3b5ec9-49546757',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_5499511a8dd1f0_69733986',
  'variables' => 
  array (
    'columna' => 0,
    'k' => 0,
    'CAMPOS' => 0,
    'objeto' => 0,
    'OBJETO' => 0,
    'tabla' => 0,
    'tabl' => 0,
    'Accion' => 0,
    'rela' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5499511a8dd1f0_69733986')) {function content_5499511a8dd1f0_69733986($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_dhtml_calendar')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\function.dhtml_calendar.php';
?> <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columna']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> <?php if (in_array($_smarty_tpl->tpl_vars['k']->value,$_smarty_tpl->tpl_vars['CAMPOS']->value)) {?>
<tr>
	<th><?php echo $_smarty_tpl->tpl_vars['objeto']->value->rotulo($_smarty_tpl->tpl_vars['k']->value);?>
</th>
	<?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="tinyint") {?>
	<th><select name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php if ($_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value}==1) {?>
		<option label="SI" selected="selected" value="1">SI</option>
		<option label="NO" value="0">NO</option>
		<?php } else { ?>
		<option label="SI" value="1">SI</option>
		<option label="NO" selected="selected" value="0">NO</option>
		<?php }?>
	</select></th>
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="char") {?>
	<th><select name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php  $_smarty_tpl->tpl_vars['tabl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tabl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabla']->value->valor($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tabl']->key => $_smarty_tpl->tpl_vars['tabl']->value) {
$_smarty_tpl->tpl_vars['tabl']->_loop = true;
?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value}==$_smarty_tpl->tpl_vars['tabl']->value->numero) {?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" selected="selected"
			value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->numero;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php } else { ?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->numero;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php }?> <?php } ?>
	</select></th>
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="date") {?>
	<th><input tabindex="1" type="text" id="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"
		value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value}," %d/%m/%Y");?>
" /> <a href=""
		id="trigger<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"><img class="calendario" src="css-imgs/cal.png"
		alt="Ver Calendario" title="Ver Calendario" /></a> <?php echo smarty_function_dhtml_calendar(array('inputField'=>((string)$_smarty_tpl->tpl_vars['k']->value),'button'=>"trigger".((string)$_smarty_tpl->tpl_vars['k']->value)),$_smarty_tpl);?>
</th>
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="longtext"||$_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="tinytext") {?>
	<th><textarea tabindex="1" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" rows="5" cols="40"><?php echo $_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value};?>
</textarea></th>
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="blob"||$_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="longblob") {?> <?php if ($_smarty_tpl->tpl_vars['Accion']->value=="altaEstablecimiento"||$_smarty_tpl->tpl_vars['Accion']->value=="editarEstablecimiento") {?>
	<th><input type="file" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" /></th>
	<?php } else { ?>
	<th>Este campo no se puede visualizar</th>
	<?php }?> <?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->esForaneo($_smarty_tpl->tpl_vars['k']->value)) {?>
	<th><select name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php if ($_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value}=='') {?>
		<option label="-- NADA --" selected="selected" value="">-- NADA --</option>
		<?php } else { ?>
		<option label="-- NADA --" value="">-- NADA --</option>
		<?php }?> <?php  $_smarty_tpl->tpl_vars['rela'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rela']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['objeto']->value->FindAll($_smarty_tpl->tpl_vars['objeto']->value->esForaneo($_smarty_tpl->tpl_vars['k']->value)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rela']->key => $_smarty_tpl->tpl_vars['rela']->value) {
$_smarty_tpl->tpl_vars['rela']->_loop = true;
?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value}==$_smarty_tpl->tpl_vars['rela']->value->GET_campo($_smarty_tpl->tpl_vars['objeto']->value->campoForaneo($_smarty_tpl->tpl_vars['k']->value))) {?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['rela']->value->leyenda();?>
" selected="selected"
			value="<?php echo $_smarty_tpl->tpl_vars['rela']->value->GET_campo($_smarty_tpl->tpl_vars['objeto']->value->campoForaneo($_smarty_tpl->tpl_vars['k']->value));?>
"><?php echo $_smarty_tpl->tpl_vars['rela']->value->leyenda();?>
</option>
		<?php } else { ?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['rela']->value->leyenda();?>
" value="<?php echo $_smarty_tpl->tpl_vars['rela']->value->GET_campo($_smarty_tpl->tpl_vars['objeto']->value->campoForaneo($_smarty_tpl->tpl_vars['k']->value));?>
"><?php echo $_smarty_tpl->tpl_vars['rela']->value->leyenda();?>
</option>
		<?php }?> <?php } ?>
	</select></th>
	<?php } else { ?>
	<th><input size="<?php echo $_smarty_tpl->tpl_vars['objeto']->value->GetLen($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value);?>
" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
"
		tabindex="1" type="text" value="<?php echo $_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value};?>
" <?php if ($_smarty_tpl->tpl_vars['k']->value=="id") {?> disabled="disabled" /><input name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" type="hidden"
		value="<?php echo $_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value};?>
" <?php }?>/></th>
	<?php }?> <?php }?> <?php }?> <?php }?> <?php }?> <?php }?>
</tr>
<?php } else { ?>
<input
	type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value};?>
" />
<?php }?> <?php } ?>
<?php }} ?>
