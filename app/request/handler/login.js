var Handler = {

	Request: function(){

		/*var def = $.Deferred();

		def.resolve("No");

		return def.promise();*/

		// $("#editarClienteModal").modal('hide');

		return "Yes";

	},

  Response: function(r){
		if(r.success){
			//reload
			location.href="/dashboard";

		}else{
			alert(r.message);
		}
    // alert(r.message);
  }
}
