var Tables = {
  almacen: function(){
    $("#almacen").css('text-align', 'center').html('<i class="fa fa-spinner fa-spin"></i> Cargando');
    webApi(webapi_backend + "almacen/consulta", "json").then(function(data) {
      if (data.length > 0) {
          $("#almacen").html('<table id="almacenTable" class="table mb-0 thead-border-top-0 data-table responsive nowrap" style="width:100% !important">');
          // Tabla de empleados
          // $('#tablaUsuarios').html('<br/><table id="table1" class="table table-striped table-bordered"></table>');
          // $('#tablaUsuarios').css('overflow-x', 'auto');
          //"url" : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
          $('#almacenTable').DataTable({
              responsive: true,
              searching: false,
              bLengthChange: !1,
              destroy: !0,
              info: !1,
              sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
              pageLength: 10,
              language: {paginate: {
                previous: "<i class='simple-icon-arrow-left'></i>",
                next: "<i class='simple-icon-arrow-right'></i>"
              }},
              columns:
              [
                  {title: 'Almacén'},
                  {title: 'Télefono'},
                  {title: 'Dirección'},
                  {title: 'Acciones'}
              ],
              data: data,
              drawCallback: function() {
                $($(".dataTables_wrapper .pagination li:first-of-type")).find("a").addClass("prev"), $($(".dataTables_wrapper .pagination li:last-of-type")).find("a").addClass("next"), $(".dataTables_wrapper .pagination").addClass("pagination-sm");
                var e = $(this).dataTable().api();
                $("#pageCountDatatable span").html("Displaying " + parseInt(e.page.info().start + 1) + "-" + e.page.info().end + " of " + e.page.info().recordsTotal + " items")
              }
          });

      } else {
          $('#almacen').html('<br/>No hay resultados que mostrar');
      }
    });
  }
}

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
