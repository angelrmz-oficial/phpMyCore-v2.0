(function ($) {
	"use strict";
  var init = function(){
		$( "table" ).each(function() {
				var table = $( this );
				table.find('tbody').html('<tr><td colspan="9" align="center"><i class="fa fa-spinner fa-spin"></i> Cargando</td></tr>');
				webApi(webapi_backend + table.data('api'), "json").then(function(data) {
				 //if (data.length > 0) {
					 table.find('tbody').html('');
						 table.DataTable({
								 responsive: true,
								 searching: true,
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
									emptyTable: "<br/>No hay resultados que mostrar"
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

				// link.append( " (" + link.attr( "href" ) + ")" );
		});
  }
  // for ajax to init again
  $.fn.dataTable.init = init;
})(jQuery);
