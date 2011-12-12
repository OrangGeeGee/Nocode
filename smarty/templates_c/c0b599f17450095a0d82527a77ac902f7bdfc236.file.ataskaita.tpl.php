<?php /* Smarty version Smarty-3.1.5, created on 2011-12-12 18:27:18
         compiled from "C:\zend\Nocode\wwwroot/../application/templates\ataskaita.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14624edbd8bd142e55-58150295%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0b599f17450095a0d82527a77ac902f7bdfc236' => 
    array (
      0 => 'C:\\zend\\Nocode\\wwwroot/../application/templates\\ataskaita.tpl',
      1 => 1323706374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14624edbd8bd142e55-58150295',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4edbd8bd360ec',
  'variables' => 
  array (
    'src' => 0,
    'checkboxes' => 0,
    'box' => 0,
    'priemones' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4edbd8bd360ec')) {function content_4edbd8bd360ec($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('js'=>"chart.js"), 0);?>


<div id="view-select">
	<a href="#" id="table-select">Lentelė</a> |
	<a href="#" id="chart-select">Grafikas</a>
	<span class="emptydataset ui-corner-all ui-state-error"">
		Duomenų pagal parinktus kriterijus nerasta
	</span>
</div>
<div class="view-wrap rounded">
	<div id="view-chart" class="views"></div>
	<div id="view-table" class="views hidden">
<table border="0" cellspacing="0" cellpadding="0">
	<caption></caption>
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
	
	</tbody>
</table>	
	</div>
</div>
<div id="filters">
	<div id="wrapper">
		<input type="hidden" id="p" value="<?php echo $_GET['p'];?>
" />
		<input type="hidden" id="src" value="<?php echo $_smarty_tpl->tpl_vars['src']->value;?>
" />
		<?php if ($_smarty_tpl->tpl_vars['src']->value!=''){?>
		<div class="update_chart" id="division-select">
			<?php if ($_smarty_tpl->tpl_vars['src']->value=="is"){?>Informacinės sistemos<?php }else{ ?>Padaliniai<?php }?>
			<span class="count" title="Pažymėtų objektų kiekis">(<?php echo count($_smarty_tpl->tpl_vars['checkboxes']->value);?>
)</span>: 
			<a href="#" id="divisions">pasirinkti</a>
			<div id="select-area">
				<input checked="checked" type="checkbox" class="masterswitch" name="master" value="1" /> Visi<br />
			<?php  $_smarty_tpl->tpl_vars['box'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['box']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['checkboxes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['box']->key => $_smarty_tpl->tpl_vars['box']->value){
$_smarty_tpl->tpl_vars['box']->_loop = true;
?>
				<input checked="checked" type="checkbox" class="subdivisions" name="subdivision[<?php echo $_smarty_tpl->tpl_vars['box']->value['id'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['box']->value['id'];?>
" />
				<?php echo $_smarty_tpl->tpl_vars['box']->value['kodas'];?>
 <i><?php echo $_smarty_tpl->tpl_vars['box']->value['pavadinimas'];?>
</i><br />
			<?php } ?>
			</div>
		</div>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['priemones']->value)){?>
		<div class="update_chart">
			Paramos priemonė:<br />
			<select name="priemone" id="priemone">
			<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['priemones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value){
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['p']->value['kodas'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['pavadinimas'];?>
</option>				
			<?php } ?>  
			</select>			
		</div>
		<?php }?>
		<div class="update_chart" id="date-select">
			Laikotarpis Nuo:<p class="rounded main-input-block"><input name="date_from" class="main-input datepicker" type="text" id="from" size="10" /></p>
			Iki: <p class="rounded main-input-block"><input value="" name="date_till" class="main-input datepicker" type="text" id="until" size="10" /></p>
		</div>
		<div class="update_chart">
			Rodyti duomenis:<br/>
			<input checked="checked" type="radio" name="show_data" value="number"> pagal apdorotą paraiškų skaičių<br/>
			<input type="radio" name="show_data" value="hours"> pagal panaudotas jų apdorojimui valandas<br/>
		</div>
	</div>
	<div id="debug" class="hidden"></div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>