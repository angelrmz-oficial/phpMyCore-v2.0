var Handler = {
	Request: function(){
		return "Yes";
	},
  Response: function(r){

		var Deferreturn = function() {
			var returned = $.Deferred();
			if(r.success){
				Tables.Cartera(), sleep(1000).then(() => {
					returned.resolve("true");
				})
			} else {
				returned.resolve("false");
			}
			return returned.promise();
		}
		Deferreturn().then(function() {
			Notifications.Alert(r.message, r.success ? "success" : "danger")
		});



  }
}
