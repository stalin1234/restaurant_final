var AppCategoria = {
	urlLanguageDataTable: '',
    urlListDataTable: '',
    objTable: null,

	index: function(){
		AppCategoria.objTable = $('#listaCategoria').DataTable({
                "processing": true,
                "serverSide": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": false,
                "language": {
                    "url": AppCategoria.urlLanguageDataTable
                },
                "columns": [
										{ "data": "idcategoria" },
										{ "data": "nombrecategoria" },
                    
                    { "data": "created_at" },
                    { "data": "accion" , "orderable" : false },
                ],
                "ajax": {
                    "url": AppCategoria.urlListDataTable,
                    "type": "get"
                }
            });

        return ;
	},





create: function()
    {
        $('#RDS06_id').selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            
        });

        $('#RDS04_especialidad').selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
           
        });

        $('.selectize-input :input').addClass('requerido');
        //$('#RDS04_especialidad').addClass('requerido');
    },
}