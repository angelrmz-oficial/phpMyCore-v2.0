var element, id;
var Handler = {
	Request: function(e){
    e.parent().find('button').attr('disabled', 'disabled');
    element=e; id = e.data('post').id; return "Yes";
	},
  Response: function(r){
		if(r.success){
      //$( "#enlazado" ).LoadTable(true);
      var gnrows = $("#general").DataTable();
      var row = element.parent().parent().parent();
      var table = $('#enlazado').DataTable();
      /*if(table.length < 1){table.clear().draw();}*/
      var data = gnrows.rows(row).data();
			//button laborado, y actualizar.
			var btn='<div class="btn-group"><button type="button" class="btn btn-sm danger postRequest" data-api="directorio/laborado" data-handler="directorioLaborado" data-post=\'{"id":"'+id+'"}\'>Laborado</button><button type="button" class="btn btn-sm primary openModal" data-modal="directorio_actualizar" data-post=\'{"id":"'+id+'"}\'>Actualizar</button></div>';
			data[0][8]=btn;
      table.row.add(data[0]).draw();
      row.remove();
		}else{
			alert(r.message);
      element.parent().find('button').removeAttr('disabled'); element=null; id = null;
    }
  }
}
