var Handler = {
	Request: function(){
		/*var def = $.Deferred();
		def.resolve("No");
		return def.promise();*/
		$("#nuevoClienteModal").modal('hide');
		return "Yes";
	},
  Response: function(r){
		//nuevoClienteForm
		Notifications.Alert(r.message, r.success ? "success" : "danger");
		if(!r.success){
			setTimeout(function(){ $("#nuevoClienteModal").modal('show'); }, 1500);
		}else{
			Tables.Cartera();
			$("#nuevoClienteForm")[0].reset();
		}
  }
}
