<?php

define('system_app', true);

require '../../../init.php';

?>
<header class="header bg-ui-general">
    <div class="header-info">
        <h1 class="header-title">
        <strong>Setup</strong>
        <small>We created an installation wizard to help you correctly configure some parameters necessary to start the framework. You can get more detailed information on the steps that the wizard follows to finish the installation.<br><br><a class="fs-12" href="https://pmc.phpsoluciones.com/docs" target="_blank">Official documentation</a></small>
        </h1>
    </div>
</header>
<div class="main-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <form id="commentForm" method="post" data-provide="wizard" data-stay-complete="true" novalidate="true" data-on-next="callbackOnNext" data-on-previous="callbackOnPrevious" data-on-finish="callbackOnFinish" onkeydown="return event.key != 'Enter';">
                  <div id="rootwizard">

                  <ul class="nav nav-process nav-process-circle">
                    <li class="nav-item">
                      <center>
                      <span class="nav-title">Step 1<br><small>Create password for administrator user</small></span></center>
                      <a id="step0" class="nav-link disabled" data-toggle="tab" href="#wizard-form-1"></a>
                    </li>

                    <li class="nav-item">
                    <center>
                      <span class="nav-title">Step 2<br><small>Web site settings</small></span></center>
                      <a id="step1" class="nav-link disabled" data-toggle="tab" href="#wizard-form-2"></a>
                    </li>

                    <li class="nav-item">
                    <center>
                      <span class="nav-title">Step 3<br><small>Connect to database</small></span></center>
                      <a id="step2" class="nav-link disabled" data-toggle="tab" href="#wizard-form-3"></a>
                    </li>

                    <li class="nav-item">
                    <center>
                      <span class="nav-title">Step 4<br><small>Installation completed</small></span></center>
                      <a id="step3" class="nav-link disabled" data-toggle="tab" href="#wizard-form-4"></a>
                    </li>
                  </ul>


                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="wizard-form-1" data-provide="validation" >

                    <p class="text-center fs-25 text-muted">Web manager account settings</p>
                    <p class="text-center text-gray">The default username is "<strong class="text-primary">admin</strong>" and you must set a password to access the web manager</p>
                    <hr class="w-100px">
                    <div class="row bg-pale-secondary px-200 py-40">

                      <div class="form-group input-group col-sm-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text w-50px"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="username" placeholder="Username" value="admin" readonly>
                      </div>

                      <div class="form-group input-group col-sm-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text w-50px"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                      </div>

                      <div class="form-group input-group col-sm-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text w-50px"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" name="confirm" data-equals="password" id="confirm_password" placeholder="Confirm password" required>
                      </div>

                    </div>

                    </div>


                    <div class="tab-pane fade disabled" id="wizard-form-2" data-provide="validation">

                      <div class="row px-200 py-40">

                        <div class="form-group input-group col-sm-6">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-tv"></i></span>
                          </div>
                          <input type="text" class="form-control" id="site_name" name="site_name" placeholder="Proyect Name" value="My First Proyect" required>
                        </div>

                        <div class="form-group input-group col-sm-6">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-paint-brush"></i></span>
                          </div>
                          <input type="text" class="form-control" id="site_theme" name="site_theme" placeholder="Template folder" value="<?= $app['settings']['site_theme']; ?>" required>
                        </div>
                      </div>

                      <div class="row px-200 py-40">

                        <div class="form-group input-group col-sm-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-cog"></i></span>
                          </div>
                          <input type="text" class="form-control" id="site_url" name="site_url" placeholder="http://localhost" value="<?= $current_url; ?>">
                        </div>

                        <div class="form-group input-group col-sm-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-cogs"></i></span>
                          </div>
                          <input type="text" class="form-control" name="site_api" id="site_api" placeholder="http://localhost/api"  value="<?= "{$current_url}/api"; ?>" required>
                        </div>

                        <div class="form-group input-group col-sm-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-cogs"></i></span>
                          </div>
                          <input type="text" class="form-control" name="site_ws" id="site_ws" placeholder="http://localhost/ws" value="<?= "{$current_url}/ws"; ?>" required>
                        </div>

                      </div>

                      <div class="row bg-pale-secondary px-200 py-40">

                        <div class="custom-control custom-control-lg custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="site_redirect" name="site_redirect" <?= ($app['settings']['site_redirect'] === true) ? 'checked="checked"' : null; ?>>
                          <label class="custom-control-label" for="site_redirect"><code>Enable</code> URL access with forced redirect <em>(http/https)</em></label>
                        </div>
                      </div>


                    </div>



                    <div class="tab-pane fade disabled" id="wizard-form-3" data-provide="validation">

                      <div class="px-200 py-40">
                        <div class="form-group  row">
                          <label class="col-form-label col-sm-4">Server*</label>
                          <div class="form-control-plaintext input-group col-sm-8">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-server"></i></span>
                          </div>
                          <input type="text" class="form-control" id="server" name="server" placeholder="localhost" value="127.0.0.1" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-form-label col-sm-4">Port*</label>
                          <div class="form-control-plaintext input-group col-sm-8">
                            <div class="input-group-prepend">
                              <span class="input-group-text w-50px"><i class="fa fa-sitemap"></i></span>
                            </div>
                            <input type="number" class="form-control" id="port" name="port" placeholder="3306" value="3306" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-form-label col-sm-4">Username*</label>
                          <div class="form-control-plaintext input-group col-sm-8">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" id="user" name="user" placeholder="root" value="root" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-form-label col-sm-4">Password</label>
                          <div class="form-control-plaintext input-group col-sm-8">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-key"></i></span>
                          </div>
                          <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" value="">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-form-label col-sm-4">Database*</label>
                          <div class="form-control-plaintext input-group col-sm-8">
                          <div class="input-group-prepend">
                            <span class="input-group-text w-50px"><i class="fa fa-database"></i></span>
                          </div>
                          <input type="text" class="form-control" id="dbname" name="dbname" placeholder="test" value="" required>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="tab-pane fade disabled" id="wizard-form-4">
                      <br><br>
                      <p class="text-center fs-35 text-muted">You have successfully installed!</p>
                      <p class="text-center text-gray">Please click on the "finish" button to start using the framework.</p>
                      <!-- <hr class="w-100px"> -->
                      <br>
                    </div>
                  </div>

                  <hr>

                  <div class="flexbox">
                    <button class="btn btn-secondary" data-wizard="prev" type="button">Back</button>
                    <button class="btn btn-secondary" data-wizard="next" data-continue="false" type="button">Next</button>
                    <button class="btn btn-primary d-none" data-wizard="finish" type="submit">Finish</button>
                  </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>

<script>

      function callbackOnNext(tab, navigation, index) {

        var btnext=$("button[data-wizard='next']");
        btnext.attr('disabled', 'disabled');

        if(btnext.data("continue")){
          btnext.data("continue", false); btnext.removeAttr('disabled');
          return true;
        }else if(index == 1){

          $.post('postep.password.php', { password: $("#password").val(), confirm:  $("#confirm_password").val() }, function(r){
            app.toast(r.message, {
              duration: 3000,
              actionTitle: r.success == true ? '¡Success!' : 'Retry',
              actionUrl:  r.success == true ? '#' : 'javascript:callbackOnNext(null, null, '+index+');',
              actionColor: r.success == true ? 'success' : 'danger'
            });
            if(r.success == true){
              $("#step"+(index)).removeClass("disabled");//.click();

              btnext.data('continue', true);
              setTimeout(function(){
                btnext.click();
              }, 1500);
            }

          }, 'json');

        }else if(index == 2){
          $.post('postep.websettings.php', {
            site_name: $("#site_name").val(),
            site_theme:  $("#site_theme").val(),
            site_url:  $("#site_url").val(),
            site_api:  $("#site_api").val(),
            site_ws:  $("#site_ws").val(),
            site_redirect:  $("#site_redirect").val()
          }, function(r){
            app.toast(r.message, {
              duration: 3000,
              actionTitle: r.success == true ? '¡Success!' : 'Retry',
              actionUrl:  r.success == true ? '#' : 'javascript:callbackOnNext(null, null, '+index+');',
              actionColor: r.success == true ? 'success' : 'danger'
            });
            if(r.success == true){
              $("#step"+(index)).removeClass("disabled");//.click();
              btnext.data('continue', true);
              setTimeout(function(){
                btnext.click();
              }, 1500);
            }

          }, 'json');
        }else if(index == 3){
          $.post('postep.database.php', {
            server: $("#server").val(),
            port:  $("#port").val(),
            username:  $("#user").val(),
            password:  $("#pass").val(),
            database:  $("#dbname").val()
          }, function(r){
            app.toast(r.message, {
              duration: 3000,
              actionTitle: r.success == true ? '¡Success!' : 'Retry',
              actionUrl:  r.success == true ? '#' : 'javascript:callbackOnNext(null, null, '+index+');',
              actionColor: r.success == true ? 'success' : 'danger'
            });
            if(r.success == true){
              $("#step"+(index)).removeClass("disabled");//.click();
              btnext.data('continue', true);
              setTimeout(function(){
                btnext.click();
              }, 1500);
            }

          }, 'json');
        }

        btnext.removeAttr('disabled');

  		}

      function callbackOnPrevious(tab, navigation, index) {
        $("#step"+(index+1)).addClass("disabled");
        $("#step"+(index)).removeClass("disabled").click();
        // app.toast('Previous');
      }


      function callbackOnFinish(tab, navigation, index) {
        $.post('postep.finish.php', function( r ) {
          app.toast(r.message, {
              duration: 3000,
              actionTitle: r.success == true ? '¡Success!' : 'Retry',
              actionUrl:  r.success == true ? '#' : 'javascript:callbackOnNext(null, null, '+index+');',
              actionColor: r.success == true ? 'success' : 'danger'
            });
            if(r.success == true){
              setTimeout(function(){
                location.href=$("#site_url").val();
              }, 1500);
            }
        }, 'json');
      }

    </script>
