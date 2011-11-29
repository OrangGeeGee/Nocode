<?php /* Smarty version Smarty-3.1.5, created on 2011-11-28 23:33:15
         compiled from "C:\Users\Anthony\GIT\Nocode\wwwroot/../application/templates\apskaita.tpl" */ ?>
<?php /*%%SmartyHeaderCode:224544ed4111cbd6b05-73531983%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa3b9511cf575aa4ef84f9bb156ecc1edee559bb' => 
    array (
      0 => 'C:\\Users\\Anthony\\GIT\\Nocode\\wwwroot/../application/templates\\apskaita.tpl',
      1 => 1322523191,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '224544ed4111cbd6b05-73531983',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.5',
  'unifunc' => 'content_4ed4111cce33e',
  'variables' => 
  array (
    'padaliniai' => 0,
    'padalinys' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4ed4111cce33e')) {function content_4ed4111cce33e($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<script type="text/javascript">
	//infoJSON;
	var chart;
	var selectionData = new Array();
	function updateView() {
		$.getJSON("index.php?ajax&p=apskaita", function(json) {
			var options = {
				chart: {
					renderTo: 'view',
					defaultSeriesType: 'line',
					marginBottom: 25,
					height:300
				},
				credits: { enabled:false },
				title: { text:"Padalinio apkrova" },
				xAxis: {
					categories: json.xAxis
				},
				yAxis: {
					title: {
						text: json.yCaption
					},
					plotLines: [{
						value: 0,
						width: 1,
						color: '#808080'
					}]
				},
				legend: {
					enabled:false
				},
				tooltip: {
					formatter: function() {
			                return '<b>'+ this.series.name +'</b><br/>'+
							this.x +': '+ this.y +' '+json.unit;
					}
				},
				series: json.data
			};
			
			chart = new Highcharts.Chart(options);
		});
		
		$.ajax({  
  			url: 'infoJSON.php',  
  			dataType: 'json',
			data:{ 'data[]': selectionData },
			type:"POST",
  			async: false,  
  			success: function(json){
				infoJSON = json;					
			}  
		});
		
	}
	$(document).ready(function() {
		updateView();
		
		$("#divisions").focus(function(){
			$("#select-area").slideDown("fast"); 
		});
		$("#save-selection").click(function(){
			$("#select-area").slideUp("fast");
			$("#select-area input:checked").each(function(){
				selectionData.push($(this).val());
			});
			updateView();
		});
	});
		
</script>

<div id="view-select"><a href="" id="table-select">Lentelė</a> | <a href="" id="chart-select">Grafikas</a></div>
<div id="view"></div>
<div id="filters">
	<div id="wrapper">
		<div id="division-select">
			Padaliniai: 
			<input type="text" id="divisions" size="10" />
			<div id="select-area">
			<?php  $_smarty_tpl->tpl_vars['padalinys'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['padalinys']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['padaliniai']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['padalinys']->key => $_smarty_tpl->tpl_vars['padalinys']->value){
$_smarty_tpl->tpl_vars['padalinys']->_loop = true;
?>
				<input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['padalinys']->value['id'];?>
" /><?php echo $_smarty_tpl->tpl_vars['padalinys']->value['pavadinimas'];?>
<br />
			<?php } ?>
				<input type="submit" id="save-selection" value="Išsaugoti" />
			</div>
		</div>
		<div id="date-select">
			Laikotarpis Nuo:<input class="datepicker" type="text" id="from" size="10" />
			Iki: <input class="datepicker" type="text" id="until" size="10" />
		</div>
	</div>
	
	<div id="show-by">
		Rodyti duomenis:<br/>
		<input type="radio" name="group1" value="number"> pagal apdorotą paraiškų skaičių<br/>
		<input type="radio" name="group1" value="hours"> pagal panaudotas jų apdorojimui valandas<br/>
	</div>
	<div id="save">
		Išsaugoti duomenų bazėje? <input type="submit" value="Taip" /><input type="submit" value="Ne" />
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>