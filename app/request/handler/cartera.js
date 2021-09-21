var Handler = {
	Request: function(){
//notie.alert({type:'success',text: 'Try input keyword to search users', position: 'top'});
    var r = confirm("¿Estás seguro de realizar esta acción?!");
    if (r == true) {
      return "Yes";
    } else {
      return "No";
    }
	},
  Response: function(r){
    notie.alert({ type: (r.success) ? 'info' : 'error', text: r.message, position: 'top' });
  }
}
