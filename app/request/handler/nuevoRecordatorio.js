var Handler = {
	Request: function(){
		return "Yes";
	},
  Response: function(r){
    notie.alert({ type: (r.success) ? 'info' : 'error', text: r.message, position: 'top' });
		if(r.success){
			$("#recordatorio")[0].reset();
      location.reload();
		}
  }
}
