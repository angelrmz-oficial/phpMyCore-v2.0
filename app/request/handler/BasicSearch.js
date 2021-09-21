var term, tb, r;
var Handler = {
	Request: function(){
    term=$("input[name='term']").val();
    tb=$("#simple");
    tb.removeClass('hide');
    rb=tb.find('.result');
    rb.html('<center><i class="fa fa-spinner fa-spin"></i> Por favor espere...</td></center>');
		return "Yes";
	},
  Response: function(r){
    $("#simple_count").removeClass('hide');
    $("#simple_count").find('.conteo').text(r.length);
    $("#simple_count").find('.term').text(term);

    rb.html('<br/><table id="simple_tb" class="table table-striped table-bordered"></table>');
    rb.css('overflow-x', 'auto');

    $('#simple_tb').DataTable({
        responsive: true,
        searching: true,
        bLengthChange: !1,
        destroy: !0,
        info: !1,
        sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
        pageLength: 10,
        language: {
          url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
          paginate: {
           previous: "<i class='fa fa-angle-left'></i>",
           next: "<i class='fa fa-angle-right'></i>"
         },
         emptyTable: "<br/>No hay resultados que mostrar"
        },
        columns:
        [
            {title: 'Nombre'},
            {title: 'Empresa'},
            {title: 'Domicilio'},
            {title: 'Correo'},
            {title: 'Teléfonos'},
            {title: 'Opciones'}
        ],
        data: r,
        drawCallback: function() {
          $($(".dataTables_wrapper .pagination li:first-of-type")).find("a").addClass("prev"), $($(".dataTables_wrapper .pagination li:last-of-type")).find("a").addClass("next"), $(".dataTables_wrapper .pagination").addClass("pagination-sm");
          var e = $(this).dataTable().api();
          $("#pageCountDatatable span").html("Displaying " + parseInt(e.page.info().start + 1) + "-" + e.page.info().end + " of " + e.page.info().recordsTotal + " items")
        }
    });

  }
}
