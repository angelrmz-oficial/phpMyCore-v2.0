// var Form = {
//   Post: function(handler, formName, data = {}){
//
//   }
// }
//
//
// $.fn.extend({
//     LoadTable: function (event, callback) {
//        /*if (this.selector) {
//             jQuery(document).on(event, this.selector, callback);
//         }*/
//         alert("ok");
//         return this;
//     }
// });

function LoadTable(table, id = false){
  if(id)
  {
      var table = $("#"+table);
  }

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
}

function cargarEmpresas(estado){

  $(".empresas").empty().select2({
    placeholder: "Cargando empresas...",
    data: null
});


  var formData = new FormData;
  formData.append('estado', estado);
  webApi(webapi_backend + '/consulta/empresas', 'json', formData).done(function(r){
    $(".empresas").select2('destroy').empty().select2({ data: r });
  }).then(function(){

  });

}



var upload = function(id_empleado, file, name){ // e = this, //var fileName = $(e)[0].files[0].name;
  var formData = new FormData;
  formData.append('id_empleado', id_empleado);
  formData.append('name', name);
  formData.append('file', file);
  var buttonup=$("#buttonup");
  var defaultxt=buttonup.html();
  buttonup.attr('disabled', 'disabled');
  buttonup.html('<i class="fas fa-spinner fa-spin"></i> Subiendo archivo...');
  webApi(webapi_backend + '/empleados/upload', 'json', formData).done(function(r){
    //Notifications.Alert(r.message, r.success ? "success" : "danger");
    toastr[r.success ? "success" : "danger"](r.message);
    console.log("cargando archivos....");
    if(r.success){
      console.log("cara de archivos....");
      Tables.Archivos(id_empleado);
    }
  }).then(function(){
    buttonup.removeAttr('disabled');
    buttonup.html(defaultxt);
    $("#uploadfile").val('');
  });

}
