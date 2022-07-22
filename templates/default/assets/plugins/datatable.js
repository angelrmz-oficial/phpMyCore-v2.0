var table = {
	load: function(table){
		table.find('tbody').html('<tr><td colspan="9" align="center"><i class="fa fa-spinner fa-spin"></i> Cargando</td></tr>');

		var data = table.data('post');//JSON.stringify(btn.data('post')); $.parseJSON

		var formData = new FormData;
		$.each(data,function(key, value){
			formData.append(key, value);
		});

		webApi(webapi_backend + table.data('api'), "json", formData).then(function(data) {
		 //if (data.length > 0) {
			 table.find('tbody').html('');
				 table.DataTable({
						 responsive: true,
						 searching: false,
						 bLengthChange: !1,
						 destroy: !0,
						 info: !1,
						 sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
						 pageLength: 10,
						 language: {
							 paginate: {
								previous: "<i class='fa fa-angle-left'></i>",
								next: "<i class='fa fa-angle-right'></i>"
							},
							emptyTable: "<br><center>No hay resultados que mostrar</center>"
						 },
						 data: data,
						 drawCallback: function() {
							 $($(".dataTables_wrapper .pagination li:first-of-type")).find("a").addClass("prev"), $($(".dataTables_wrapper .pagination li:last-of-type")).find("a").addClass("next"), $(".dataTables_wrapper .pagination").addClass("pagination-sm");
							 var e = $(this).dataTable().api();
							 $("#pageCountDatatable span").html("Displaying " + parseInt(e.page.info().start + 1) + "-" + e.page.info().end + " of " + e.page.info().recordsTotal + " items")
						 }
				 });

		 //} //else {
				 //table.DataTable();//.clear().draw();
		 //}
	 });
	}
}

$( "table" ).each(function() {
	var defined = $(this).data('api');
	if(typeof defined !== 'undefined'){
			table.load($( this ));
	}
		// link.append( " (" + link.attr( "href" ) + ")" );
});


$("#search").on("keyup", function(e) {
	// $("#"+ $(this).data('table')).DataTable().search($(this).val()).draw()
	var value=$(this).val();
	$("#"+$(this).data('table')+" tbody>tr").each(function(index) {
		var found = 'false';
		 $(this).each(function(){
					if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
					{
							 found = 'true';
					}
		 });
		 if(found == 'true')
		 {
					$(this).show();
		 }
		 else
		 {
					$(this).hide();
		 }
	});

}),$("#pageCountDatatable .dropdown-menu a").on("click", function(e) {
	$("#"+ $("#pageCountDatatable").data('table')).DataTable().page.len(parseInt($(this).text())).draw()
});
