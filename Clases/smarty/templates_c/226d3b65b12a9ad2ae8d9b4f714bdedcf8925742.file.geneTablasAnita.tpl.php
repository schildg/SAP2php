<?php /* Smarty version Smarty-3.1.18, created on 2014-08-26 13:19:28
         compiled from "C:\DATOS-DE-USUARIOS\workspace\SAP2php\Clases\smarty\templates\geneTablasAnita.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3238053fcb390adfe96-99716417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '226d3b65b12a9ad2ae8d9b4f714bdedcf8925742' => 
    array (
      0 => 'C:\\DATOS-DE-USUARIOS\\workspace\\SAP2php\\Clases\\smarty\\templates\\geneTablasAnita.tpl',
      1 => 1407933183,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3238053fcb390adfe96-99716417',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'self' => 0,
    'sf_arc' => 0,
    'relacion' => 0,
    'arc' => 0,
    'arreglo_sql_completo' => 0,
    'arre' => 0,
    'arreglo_sql_completo_diccionario' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.18',
  'unifunc' => 'content_53fcb390c60391_63610540',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fcb390c60391_63610540')) {function content_53fcb390c60391_63610540($_smarty_tpl) {?><h1>Generador de Tablas de Anita</h1>
<form action="<?php echo $_smarty_tpl->tpl_vars['self']->value;?>
" method="post">
<table summary="Generador de Tablas de Anita" border="0">
	<tbody>
		<tr>
			<th>
			<h2>Seleccione una Tabla del sistema Anita (sf-arch.inx)</h2>
			</th>
			<th><select name="sf_arc_id" tabindex="1">
				<?php if ($_smarty_tpl->tpl_vars['sf_arc']->value->id==0) {?>
				<option label="-- NADA --" selected="selected" value="0">-- NADA --</option>
				<?php } else { ?>
				<option label="-- NADA --" value="0">-- NADA --</option>
				<?php }?> 
				<?php  $_smarty_tpl->tpl_vars['arc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['arc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relacion']->value->FindAll('Sf_Arc','nsap_sf = 1'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['arc']->key => $_smarty_tpl->tpl_vars['arc']->value) {
$_smarty_tpl->tpl_vars['arc']->_loop = true;
?>
					<?php if ($_smarty_tpl->tpl_vars['sf_arc']->value->id==$_smarty_tpl->tpl_vars['arc']->value->id) {?>
					<option label="<?php echo $_smarty_tpl->tpl_vars['arc']->value->leyenda();?>
" selected="selected"
						value="<?php echo $_smarty_tpl->tpl_vars['arc']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['arc']->value->leyenda();?>
</option>
					<?php } else { ?>
					<option label="<?php echo $_smarty_tpl->tpl_vars['arc']->value->leyenda();?>
" value="<?php echo $_smarty_tpl->tpl_vars['arc']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['arc']->value->leyenda();?>
</option>
					<?php }?> 
				<?php } ?>
			</select>
			<th><input value="Generar" tabindex="1" type="submit" /> 
				<input type="hidden" name="accion" value="generarTablasAnita" /></th>
			<tr>
			</tr>
	
	</tbody>
</table>

</form>


<?php if ($_smarty_tpl->tpl_vars['arreglo_sql_completo']->value) {?>
<div class="lista">
<table class="lista" summary="Resultado de las SQL" border="0">
	<tbody>
		<tr>
			<th>SQL</th>
			<th colspan="1"></th>
			
		</tr>
		<?php  $_smarty_tpl->tpl_vars['arre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['arre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arreglo_sql_completo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['arre']->key => $_smarty_tpl->tpl_vars['arre']->value) {
$_smarty_tpl->tpl_vars['arre']->_loop = true;
?>
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td><?php echo $_smarty_tpl->tpl_vars['arre']->value['sql'];?>
</td>
			<td width="1%">
				<?php if ($_smarty_tpl->tpl_vars['arre']->value['error']) {?>
					<img class="ordenar" src="css-imgs/error_sql.png" alt="<?php echo $_smarty_tpl->tpl_vars['arre']->value['mensaje_e'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['arre']->value['mensaje_e'];?>
" />
				<?php } else { ?>
					<img class="ordenar" src="css-imgs/ok_sql.png" alt="SQL ok" title="SQL ok" />
				<?php }?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>

<br>
<br>
<br>


<div class="lista">
<table class="lista" summary="Resultado de las SQL" border="0">
	<tbody>
		<tr>
			<th>Carga del Diccionario de Datos</th>
			<th colspan="1"></th>
			
		</tr>
		<?php  $_smarty_tpl->tpl_vars['arre'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['arre']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['arreglo_sql_completo_diccionario']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['arre']->key => $_smarty_tpl->tpl_vars['arre']->value) {
$_smarty_tpl->tpl_vars['arre']->_loop = true;
?>
		<tr onmouseout="this.bgColor='Linen'"
			onmouseover="this.bgColor='Coral'">
			<td><?php echo $_smarty_tpl->tpl_vars['arre']->value['sql'];?>
</td>
			<td width="1%">
				<?php if ($_smarty_tpl->tpl_vars['arre']->value['error']) {?>
					<img class="ordenar" src="css-imgs/error_sql.png" alt="<?php echo $_smarty_tpl->tpl_vars['arre']->value['mensaje_e'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['arre']->value['mensaje_e'];?>
" />
				<?php } else { ?>
					<img class="ordenar" src="css-imgs/ok_sql.png" alt="SQL ok" title="SQL ok" />
				<?php }?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>




<?php }?><?php }} ?>
