var Handler = {
	Request: function(){
		/*var def = $.Deferred();
		def.resolve("No");
		return def.promise();*/
		$("#editarClienteModal").modal('hide');
		return "Yes";
	},
  Response: function(r){
		var Deferreturn = function() {
			var returned = $.Deferred();
			if(r.success){
				Tables.Cartera(), sleep(1000).then(() => {
					$("#editarClienteModal").remove();
					returned.resolve("true");
				})
			} else {
				$("#editarClienteModal").modal('show');
				returned.resolve("false");
			}
			return returned.promise();
		}
		Deferreturn().then(function() {
			Notifications.Alert(r.message, r.success ? "success" : "danger")
		});


  }
}
