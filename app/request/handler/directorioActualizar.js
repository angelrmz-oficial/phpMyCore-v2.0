// var element, id;
var tableId;
var Handler = {
	Request: function(e){
		//saber de donde viene?
		tableId=e.data('table');
    return "Yes";
	},
  Response: function(r){
    alert(r.message);
		if(r.success){
      $("#directorioActualizar").modal('hide');
      $("#"+tableId).LoadTable();
			tableId=null;
    }
  }
}
