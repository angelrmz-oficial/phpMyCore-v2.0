<!-- Scripts -->
<script src="assets/js/core.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script type="text/javascript">
    var Form = {
      Load: function(formName, data = null){
        //$("#sidebar").hide();
        
        var child = $("#qv-user-details");
        /*var parent = child.parent();*/
        child.attr('style', 'background-color: rgba(0,0,0,0.6);');
        child.html('<div style="display: flex;justify-content: center;align-items: center;margin-top:50%;color:white"><div class="fa-3x"><i class="fa fa-spinner fa-spin"></i><br></div></div>');

        child.load('load.'+formName+'.php', data, function(){
          child.removeAttr('style');
        });
      },
      Post: function(formName, data = null){
        $.post('post.'+formName+'.php', data, function(r){
          
          app.toast(r.message, {
              duration: 3000,
              actionTitle: r.success == true ? '¡Success!' : 'Error!',
              actionUrl:  '#',
              actionColor: r.success == true ? 'success' : 'danger'
            });
            if(r.success){
              setTimeout(function(){
                  location.reload();
                }, 3200);
            }
            
          //alert(r.message);
          // if(r.success){
          //   location.reload();
          // }
        }, 'json');
      }
    }

    /*var Load = {
      Router: function(name){
        alert(name);
      },
      Options: function(){
        alert("load");
      }
    }

    /*$('select').on('click',function(ev){
        alert("xd")
    });*/

    $('body').delegate('form','submit',function(event){
      event.preventDefault();
      if($(this).attr("action") !== ""){
        return true;
      }
      var submit = $(this).find('button[type=submit]');
      if(!submit.length){
        submit = $(this).find('input[type=submit]');
      }
      submit.attr('disabled', 'disabled');
      var formData = new FormData(this);

    //select2('val'
      var select = $(this).find("select");
      select.each(function(){
        if($(this).hasClass('select2')){
          formData.delete($(this).attr('name'));
          $.each($(this).serializeArray(), function( i, field ) {
            formData.append(field.name+"["+i+"]", field.value);
          });
        }
      });

      var checkboxs = $(this).find("input[type=checkbox]");
      checkboxs.each(function(){ formData.delete($(this).attr('name')); });
      checkboxs.each(function(){
        formData.append($(this).attr('name'), $(this).is(':checked') ? "on" : "off");
      });
      var data = {};
      formData.forEach((value, key) => {data[key] = value});
      $.post('post.'+submit.attr('name')+'.php', data, function(r){
        
        app.toast(r.message, {
          duration: 3000,
          actionTitle: r.success == true ? '¡Success!' : 'Error!',
          actionUrl:  '#',
          actionColor: r.success == true ? 'success' : 'danger'
        });
        if(r.success){
          setTimeout(function(){
              location.reload();
            }, 3200);
        }else{
          submit.removeAttr('disabled');
        }
      }, 'json');

    });
    </script>