
 selectedCategoria : function  (){



$(document).ready(function(){

	alert("hola");
	$('#skill').tokenfield({
		autocomplete: {
			source: ['PHP','Codeigniter','HTML','JQuery','Javascript','CSS','Laravel','CakePHP','Symfony','Yii 2','Phalcon','Zend','Slim','FuelPHP','PHPixie','Mysql'],
			delay: 100
		},
		showAutocompleteOnFocus: true
	});



$('#idcategoria').selectize({
    maxItems: 3
});

}


$select_state = $('#select-cities-state').selectize({
						onChange: function(value) {
							if (!value.length) return;
							select_city.disable();
							select_city.clearOptions();
							select_city.load(function(callback) {
								xhr && xhr.abort();
								xhr = $.ajax({
									url: 'https://jsonp.afeld.me/?url=http://api.sba.gov/geodata/primary_city_links_for_state_of/' + value + '.json',
									success: function(results) {
										select_city.enable();
										callback(results);
									},
									error: function() {
										callback();
									}
								})
							});
						}
					});






					$('#select-repo').selectize({ 
						valueField: 'url',
						 labelField: 'name',
						  searchField: 'name',
						   options: [],
						    create: false,
						     render: {
						      option: function(item, escape)
						       { return "<option value='" + item.id + "'>" + item.name + "</option>"; } },
						        load: function(query, callback)
						         { if (!query.length) 
						         	return callback(); 
						         	$.ajax({
						         	 url: urlBase+'/ajaxs/customer', 
						         		type: 'POST', 
						         		dataType: 'JSON', 
						         		data: {query:query},
						         		 success: function(data) {
						         		  callback(data); }, 
						         		  error: function(xhr, textStatus, error){ callback(); } }); } });