var element, id;
var Handler = {
	Request: function(e){
    e.parent().find('button').attr('disabled', 'disabled');
    element=e; id = e.data('post').id;
    var r = confirm("¿Estás seguro que deseas continuar?");
    if (r == true) { return "Yes"; } else {  element.parent().find('button').removeAttr('disabled'); return "No"; }
	},
  Response: function(r){
		if(r.success){
      //$( "#enlazado" ).LoadTable(true);
      var row = element.parent().parent().parent();
      row.remove();
		}else{
			alert(r.message);
      element.parent().find('button').removeAttr('disabled'); element=null; id = null;
    }
  }
}
