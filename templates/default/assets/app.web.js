var webApi = function(url, type, params=new FormData) {
  params.append('response-type', type);
  return $.ajax({
  	url: url,
  	type:'POST',
  	data: params,
  	dataType: type,
  	cache: false,
  	// asyc: false,
  	contentType: false,
  	processData: false,
  	xhrFields: {
  		withCredentials: true
  	},
  	success: function(r){

  	},
  	error: function (xhr, ajaxOptions, thrownError) {
		  console.log(xhr); console.log(ajaxOptions); console.log(thrownError);
  	}
		//method: 'POST'
  });
}
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

$(document).ready(function() {

/*
  $('body').delegate('.nav-link','click',function(event){
    var btn = $(this);

  });*/

  $('body').delegate('.openModal','click',function(event){
    var btn = $(this);
    var defaultext=btn.html();
    btn.attr('disabled', 'disabled');
    btn.html('Espere...');
    var formData = new FormData;
    $.each(btn.data('post'),function(key, value){
      formData.append(key, value);
    });
    formData.append('modal', btn.data('modal'))
    webApi(webapi_backend + '/load/modal', 'html', formData).done(function(r){
        $(r).modal();
    }).then(function(){
      btn.removeAttr('disabled');
      btn.html(defaultext);
    });
  });

  $('body').delegate('.postRequest','click',function(event){
    var btn = $(this);

    var formName = btn.data('api');
    var handler = btn.data('handler');
    var data = btn.data('post');//JSON.stringify(btn.data('post')); $.parseJSON

    var formData = new FormData;
    $.each(data,function(key, value){
      formData.append(key, value);
    });
    var defaultext=btn.html();
    btn.attr('disabled', 'disabled');
    btn.html('Espere...');

    $.getScript( webapi_frontend + handler + ".js").done(function(){
      if(Handler.Request(btn) == "Yes"){
        webApi(webapi_backend + formName, 'json', formData).done(function(r){
          Handler.Response(r);
        }).fail(function(){

        }).then(function(){
          btn.removeAttr('disabled');
          btn.html(defaultext);
        });
      }else{
        btn.removeAttr('disabled');
        btn.html(defaultext);
      }
    }).fail(function(){
      webApi(webapi_backend + formName, 'json', formData).done(function(r){
        console.log(r);
      }).fail(function(){
        console.log("fail");
      }).then(function(){
        btn.removeAttr('disabled');
        btn.html(defaultext);
      });
    });
  });

  $('body').delegate('form','submit',function(event){
    if($(this).attr("action") !== ""){
      return false;
    }

    var submit = $(this).find('button[type=submit]');
    var inputype=false;
    if(!submit.length){
      submit = $(this).find('input[type=submit]');
      inputype=true;
    }

    if(!inputype){
			var resetext=submit.html();
	    submit.attr('disabled', 'disabled');
	    submit.html('<i class="fa fa-spinner fa-spin"></i> Cargando');
		}
		else{
			var resetext=submit.val();
	    submit.attr('disabled', 'disabled');
	    submit.val('Cargando...');
		}
    var formData = new FormData(this);
    var checkboxs = $(this).find("input[type=checkbox]");
    checkboxs.each(function(){ formData.delete($(this).attr('name')); });
    checkboxs.each(function(){
      formData.append($(this).attr('name'), $(this).is(':checked') ? "on" : "off");
    });

    var handler=$(this).data('handler');
    var url = submit.data('external') ? submit.data('api') : webapi_backend + submit.data('api');

    $.getScript( webapi_frontend + handler + ".js").done(function(){
      if(Handler.Request(submit) == "Yes"){
        webApi(url, submit.data('type'), formData).done(function(r) {
          Handler.Response(r);
        }).fail(function(){
          alert("error");
  				if(!inputype){
  					submit.removeAttr('disabled');
            submit.html(resetext);
  				}
  				else{
  					submit.removeAttr('disabled');
            submit.val(resetext);
  				}

        }).then(function(r){
  				if(!inputype){
  					submit.removeAttr('disabled');
            submit.html(resetext);
  				}
  				else{
  					submit.removeAttr('disabled');
            submit.val(resetext);
  				}
        });
        //done and fail
      }
      else{
  			if(!inputype){
  				submit.removeAttr('disabled');
  				submit.html(resetext);
  			}
  			else{
  				submit.removeAttr('disabled');
  				submit.val(resetext);
  			}
      }

    }).fail(function() {
      webApi(url, submit.data('type'), formData).done(function(response) {

      }).fail(function(){
        alert("error");
  			if(!inputype){
  				submit.removeAttr('disabled');
  				submit.html(resetext);
  			}
  			else{
  				submit.removeAttr('disabled');
  				submit.val(resetext);
  			}
      }).then(function(r){
  			if(!inputype){
  				submit.removeAttr('disabled');
  				submit.html(resetext);
  			}
  			else{
  				submit.removeAttr('disabled');
  				submit.val(resetext);
  			}
      });

      // submit.html(resetext);
    });

    return false;

  });
});

function notify(title, message, type = 'primary', f = 'top', p = 'right'){
  $.notify({
    title: title,
    message: message,
    target: "_blank"
  }, {
    element: "body",
    position: null,
    type: type,
    allow_dismiss: !0,
    newest_on_top: !1,
    showProgressbar: !1,
    placement: {
      from: f,
      align: p
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 4e3,
    timer: 2e3,
    url_target: "_blank",
    mouse_over: null,
    animate: {
      enter: "animated fadeInDown",
      exit: "animated fadeOutUp"
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: "class",
    template: '<div data-notify="container" class="col-11 col-sm-3 alert  alert-{0} " role="alert"><button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button><span data-notify="icon"></span> <span data-notify="title">{1}</span> <span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>'
  });
}

var Notifications = {
  Success: function(message){
    notify('<b>Realizado con éxito</b>', message, 'success');
  },
  Error: function(message){
    notify('<b>Opps!</b> Algo salio mal', message, 'danger');
  },
  Alert: function(message, type){
    type == "success" ? Notifications.Success(message) : Notifications.Error(message);
  }
}

const sleep = (milliseconds) => {
  return new Promise(resolve => setTimeout(resolve, milliseconds))
}
