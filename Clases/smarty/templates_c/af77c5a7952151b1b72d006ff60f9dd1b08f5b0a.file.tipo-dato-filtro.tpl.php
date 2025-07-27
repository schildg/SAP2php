<?php /* Smarty version Smarty-3.1.18, created on 2015-03-19 16:17:56
         compiled from "C:\Sistema_php_anita\Portal\SAP2php\Clases\smarty\templates\tipo-dato-filtro.tpl" */ ?>
<?php /*%%SmartyHeaderCode:235254986112638220-98131510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af77c5a7952151b1b72d006ff60f9dd1b08f5b0a' => 
    array (
      0 => 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\templates\\tipo-dato-filtro.tpl',
      1 => 1426529020,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235254986112638220-98131510',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_54986113638042_95871019',
  'variables' => 
  array (
    'columna' => 0,
    'OBJETO' => 0,
    'k' => 0,
    'objeto' => 0,
    'sel' => 0,
    'tabla' => 0,
    'filtro' => 0,
    'tabl' => 0,
    'relacion' => 0,
    'rela' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54986113638042_95871019')) {function content_54986113638042_95871019($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_dhtml_calendar')) include 'C:\\Sistema_php_anita\\Portal\\SAP2php\\Clases\\smarty\\plugins\\function.dhtml_calendar.php';
?> <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['columna']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)!="timestamp") {?>
<tr>
	<th><?php echo $_smarty_tpl->tpl_vars['objeto']->value->rotulo($_smarty_tpl->tpl_vars['k']->value);?>
</th>
	<th><input tabindex="1" name="sel-<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" type="checkbox"<?php if ($_smarty_tpl->tpl_vars['sel']->value[$_smarty_tpl->tpl_vars['k']->value]) {?> checked <?php }?>></th>
	<?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="tinyint") {?>
	<th><select name="filtro-<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php  $_smarty_tpl->tpl_vars['tabl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tabl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabla']->value->valor('FILTRO','BOOLEAN'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tabl']->key => $_smarty_tpl->tpl_vars['tabl']->value) {
$_smarty_tpl->tpl_vars['tabl']->_loop = true;
?> <?php if ($_smarty_tpl->tpl_vars['filtro']->value[$_smarty_tpl->tpl_vars['k']->value]==$_smarty_tpl->tpl_vars['tabl']->value->noco) {?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" selected="selected"
			value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php } else { ?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php }?> <?php } ?>
	</select></th>
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="date") {?>
	<th><select name="filtro-<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php  $_smarty_tpl->tpl_vars['tabl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tabl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabla']->value->valor('FILTRO','DATE'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tabl']->key => $_smarty_tpl->tpl_vars['tabl']->value) {
$_smarty_tpl->tpl_vars['tabl']->_loop = true;
?> <?php if ($_smarty_tpl->tpl_vars['filtro']->value[$_smarty_tpl->tpl_vars['k']->value]==$_smarty_tpl->tpl_vars['tabl']->value->noco) {?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" selected="selected"
			value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php } else { ?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php }?> <?php } ?>
	</select></th>
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="varchar") {?>
	<th><select name="filtro-<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php  $_smarty_tpl->tpl_vars['tabl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tabl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabla']->value->valor('FILTRO','STRING'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tabl']->key => $_smarty_tpl->tpl_vars['tabl']->value) {
$_smarty_tpl->tpl_vars['tabl']->_loop = true;
?> <?php if ($_smarty_tpl->tpl_vars['filtro']->value[$_smarty_tpl->tpl_vars['k']->value]==$_smarty_tpl->tpl_vars['tabl']->value->noco) {?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" selected="selected"
			value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php } else { ?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php }?> <?php } ?>
	</select></th>
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="int") {?>
	<th><select name="filtro-<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php  $_smarty_tpl->tpl_vars['tabl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tabl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabla']->value->valor('FILTRO','INTEGER'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tabl']->key => $_smarty_tpl->tpl_vars['tabl']->value) {
$_smarty_tpl->tpl_vars['tabl']->_loop = true;
?> <?php if ($_smarty_tpl->tpl_vars['filtro']->value[$_smarty_tpl->tpl_vars['k']->value]==$_smarty_tpl->tpl_vars['tabl']->value->noco) {?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" selected="selected"
			value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php } else { ?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php }?> <?php } ?>
	</select></th>
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="char") {?>
	<th><select name="filtro-<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php  $_smarty_tpl->tpl_vars['tabl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tabl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabla']->value->valor('FILTRO','BINARY'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tabl']->key => $_smarty_tpl->tpl_vars['tabl']->value) {
$_smarty_tpl->tpl_vars['tabl']->_loop = true;
?> <?php if ($_smarty_tpl->tpl_vars['filtro']->value[$_smarty_tpl->tpl_vars['k']->value]==$_smarty_tpl->tpl_vars['tabl']->value->noco) {?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" selected="selected"
			value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php } else { ?>
		<option label="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tabl']->value->noco;?>
"><?php echo $_smarty_tpl->tpl_vars['tabl']->value->nombre;?>
</option>
		<?php }?> <?php } ?>
	</select></th>
	<?php } else { ?>
	<th></th>
	<?php }?> <?php }?> <?php }?> <?php }?> <?php }?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->GetType($_smarty_tpl->tpl_vars['OBJETO']->value,$_smarty_tpl->tpl_vars['k']->value)=="tinyint") {?>
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
	<?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['objeto']->value->esForaneo($_smarty_tpl->tpl_vars['k']->value)) {?>
	<th><select name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" tabindex="1">
		<?php if ($_smarty_tpl->tpl_vars['objeto']->value->{$_smarty_tpl->tpl_vars['k']->value}==0) {?>
		<option label="-- NADA --" selected="selected" value="0">-- NADA --</option>
		<?php } else { ?>
		<option label="-- NADA --" value="0">-- NADA --</option>
		<?php }?> <?php  $_smarty_tpl->tpl_vars['rela'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rela']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relacion']->value->FindAll($_smarty_tpl->tpl_vars['objeto']->value->esForaneo($_smarty_tpl->tpl_vars['k']->value)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
" /></th>
	<?php }?> <?php }?> <?php }?> <?php }?>
</tr>
<?php }?> <?php } ?>
<?php }} ?>
