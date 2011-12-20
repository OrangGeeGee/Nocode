$(function() {
	$(".admincontent").delegate(".edit", "change", function() {
		edit(this);
	});
});

function insert(caller) {
	var row = $(caller).closest("tr");
	var fields = row.find(".insert");
	var tableName = row.closest("table").data("table");
	var json = { action:"insert", table:tableName };
	fields.each(function() {
		var field = $(this);
		if(field.val().length>0) {
			json["fields["+field.attr("name")+"]"] = field.val();
		}
	});
	$.get("admin.php", json, function(response) {
		if(response.length>0) {
			showError(response);
		} else refresh();
	});
}

function remove(caller) {
	var row = $(caller).closest("tr");
	var field = row.find(".edit:first");
	var tableName = row.closest("table").data("table");
	json = {
		action:"delete",
		table:tableName, 
		whereField:field.data("whereField"),
		whereValue:field.data("whereValue")
	}
	$.get("admin.php", json, function(response) {
		if(response.length>0) {
			showError(response);
		} else refresh();
	});
}
function edit(field) {
	var $field = $(field);
	var tableName = $field.closest("table").data("table");
	var value = $field.val();
	json = {
		action:"set",
		table:tableName,
		field:$field.data("field"),
		value:value,
		whereField:$field.data("whereField"),
		whereValue:$field.data("whereValue")
	}
	$.get("admin.php", json, function(response) {
		if(response.length>0) {
			$field.val( $field.data("originalValue") );
			showError(response);
		} else {
			$field.data("originalValue", value);
		}
	});
}
function refresh() {
	location.reload(true);
}
function showError(response) {
	alert(response);
}