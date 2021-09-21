<?php require 'load.logged.php';
if(!in_array("users", $userApp['permissions']))
  die("No tiene permiso necesario para realizar esta acción");

foreach ($app['users'] as $user)
  if($user['username'] == $post['username'])
    $userEdit=$user;

?>
<form action="" method="post">

<div class="quickview-body">
    
      <input type="hidden" name="user" value="<?= $userEdit['username']; ?>">

        <div class="card card-inverse">
          <div class="flexbox px-20 pt-20">
            <label class="toggler text-white">
            </label>

            <a class="text-white fs-20 lh-1" href="javascript:confirm('¿Seguro que desea eliminar el usuario <?= $user['username']; ?>?') ? Form.Post('deleteuser', {username: '<?= $user['username']; ?>'}) : void(0);"><i class="fa fa-trash"></i></a>
          </div>

          <div class="card-body text-center pb-50">
            <a href="#">
              <img class="avatar avatar-xxl avatar-bordered" src="assets/img/avatar/default.jpg">
            </a>
            <h4 class="mt-2 mb-0"><a class="hover-primary text-white" href="#"><?= $userEdit['username']; ?></a></h4>
            <!--<span><?= $userEdit['last_connection']; ?></span> -->
          </div>
        </div>

        
          
        <div class="quickview-block ">
          <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="username"  class="form-control" value="<?= $userEdit['username']; ?>" required>
          </div>

          <div class="form-group">
            <label>Contraseña</label>
            <input class="form-control" type="password" name="password">
          </div>

          <div class="form-group">
            <label>Direcciones IP</label>
            <input type="text" class="form-control" name="ips" value="<?= implode(";", $userEdit['ips']); ?>">
            
          </div>

          <!--
          <div class="h-40px"></div>
          <div class="form-group">
            <select class="form-control" data-provide="selectpicker">
              <option>United States</option>
              <option>Canada</option>
              <option>Mexico</option>
              <option>Japan</option>
              <option>Other</option>
            </select>
            <label>Country</label>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" value="San Fransisco">
            <label>City</label>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" value="1135, Apt 2, Main St.">
            <label>Address</label>
          </div>-->
            <label>Permisos</label>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_users" <?= in_array("users", $userEdit['permissions']) ? 'checked' : null; ?>>
                <label class="custom-control-label">Users</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_site" <?= in_array("site", $userEdit['permissions']) ? 'checked' : null; ?>>
                <label class="custom-control-label">Site</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_router" <?= in_array("router", $userEdit['permissions']) ? 'checked' : null; ?>>
                <label class="custom-control-label">Router</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_system" <?= in_array("system", $userEdit['permissions']) ? 'checked' : null; ?>>
                <label class="custom-control-label">System</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_mysql" <?= in_array("mysql", $userEdit['permissions']) ? 'checked' : null; ?>>
                <label class="custom-control-label">MySQL</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_files" <?= in_array("files", $userEdit['permissions']) ? 'checked' : null; ?>>
                <label class="custom-control-label">Files</label>
            </div>


        </div>
      </div>

      <footer class="p-12 text-right">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview">Cancelar</button>
        <button class="btn btn-flat btn-primary" type="submit" name="edituser">Aplicar cambios</button>
      </footer>

</form>
