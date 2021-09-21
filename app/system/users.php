<?php require 'logged.php';
$page['id']=2;
$page['title']="Users | phpMyCore | ". site_name;
require 'tpl/head.php'; ?>
    <body>
        <?php require 'tpl/sidebar.php'; require 'tpl/header.php'; ?>
        <!-- Main container -->
        <main class="main-container">
            <div class="main-content">
              <div class="media-list media-list-divided media-list-hover" data-provide="selectall">

        <header class="flexbox align-items-center media-list-header bg-transparent b-0 py-16 pl-20">
          <div class="flexbox align-items-center">
            <!--<div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <label class="custom-control-label"></label>
            </div>

            <span class="divider-line mx-1"></span>

            <div class="dropdown">
              <a class="btn btn-sm dropdown-toggle" data-toggle="dropdown" href="#">Sort by</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Date</a>
                <a class="dropdown-item" href="#">Name</a>
                <a class="dropdown-item" href="#">Balance</a>
                <a class="dropdown-item" href="#">Popular</a>
              </div>
            </div> -->
          </div>

          <div>
            <div class="lookup lookup-circle lookup-right">
              <input type="text" data-provide="media-search">
            </div>
          </div>
        </header>


        <div class="media-list-body bg-white b-1">

        <?php foreach ($app['users'] as $user): ?>
          <div class="media align-items-center">

            <a class="flexbox align-items-center flex-grow gap-items" href="#qv-user-details" data-toggle="quickview" onclick="Form.Load('edituser', {username: '<?= $user['username']; ?>'})">
              <img class="avatar" src="assets/img/avatar/default.jpg" alt="...">

              <div class="media-body text-truncate">
                <h6><?= $user['username']; ?></h6>
                <small>
                  <span><?= empty($user['last_connection']) ? "Sin conexión" : "Última conexión {$user['last_connection']}"; ?></span>
                  <?php if(!empty($user['last_ip'])): ?><span class="divider-dash">IP <?= $user['last_ip']; ?></span><?php endif; ?>

                  <?php if(count($user['ips']) > 0): ?><span class="divider-dash">Autorizados: <?php $ips=""; foreach($user['ips'] as $ip): $ips.= "{$ip} / "; endforeach; echo trim($ips, ' / '); endif; ?>

                </small>
              </div>
            </a>

            <span class="lead text-fade mr-25 d-none d-md-block" title="Permisos" data-provide="tooltip"><?= implode(", ", $user['permissions']); ?></span>

            <div class="dropdown">
              <a class="text-lighter" href="#" data-toggle="dropdown"><i class="ti-more-alt rotate-90"></i></a>
              <div class="dropdown-menu dropdown-menu-right">
                <!--<a class="dropdown-item" href="#"><i class="fa fa-fw fa-phone"></i> Call</a>
                <a class="dropdown-item" href="#"><i class="fa fa-fw fa-commenting"></i> Message</a>-->
                <a class="dropdown-item" href="#qv-user-details" data-toggle="quickview" onclick="Form.Load('edituser', {username: '<?= $user['username']; ?>'})"><i class="fa fa-fw fa-edit"></i> Modificar</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:confirm('¿Seguro que desea eliminar el usuario <?= $user['username']; ?>?') ? Form.Post('deleteuser', {username: '<?= $user['username']; ?>'}) : void(0);"><i class="fa fa-fw fa-trash"></i> Eliminar</a>
              </div>
            </div>
          </div>

          <?php endforeach; ?>
          

        <!--
        <footer class="flexbox align-items-center py-20">
          <span class="flex-grow text-right text-lighter pr-2">1-10 of 1,853</span>
          <nav>
            <a class="btn btn-sm btn-square disabled" href="#"><i class="ti-angle-left"></i></a>
            <a class="btn btn-sm btn-square" href="#"><i class="ti-angle-right"></i></a>
          </nav>
        </footer>-->

      </div>
            </div><!--/.main-content -->
        <?php require 'tpl/footer.php'; ?>
        </main>

        <div class="fab fab-fixed">
      <a class="btn btn-float btn-primary" href="#qv-user-add" title="Nuevo usuario" data-provide="tooltip" data-toggle="quickview"><i class="ti-plus"></i></a>
    </div>




    <!-- Quickview - Add user -->
    <div id="qv-user-add" class="quickview quickview-lg">
    <form action="" method="post">
      <header class="quickview-header">
        <p class="quickview-title lead fw-400">Agregar nuevo usuario</p>
        <span class="close"><i class="ti-close"></i></span>
      </header>

      <div class="quickview-body">

        <div class="quickview-block form-type-material">
          <!--<h6>Personal information</h6>-->
          <div class="form-group">
            <input type="text" class="form-control" name="username" required>
            <label>Usuario</label>
          </div>

          <div class="form-group">
            <input type="password" name="password" required class="form-control">
            <label>Contraseña</label>
          </div>

          <div class="form-group">
            <input name="ips" class="form-control">
            <label>Direcciones IP</label>
          </div>

         
          <label>Permisos</label>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_users">
                <label class="custom-control-label">Users</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_site">
                <label class="custom-control-label">Site</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_router">
                <label class="custom-control-label">Router</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_system">
                <label class="custom-control-label">System</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_mysql">
                <label class="custom-control-label">MySQL</label>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="permission_files">
                <label class="custom-control-label">Files</label>
            </div>


        </div>
      </div>

      <footer class="p-12 text-right">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview">Cancelar</button>
        <button class="btn btn-flat btn-primary" type="submit" name="adduser">Agregar usuario</button>
      </footer>
        </form>
    </div>
    <!-- END Quickview - Add user -->




    <!-- Quickview - User detail -->
    <div id="qv-user-details" class="quickview quickview-lg">
      

    </div>
    <!-- END Quickview - User detail -->

        <!-- END Main container -->
        <?php require 'tpl/scripts.php'; ?>
    </body>
</html>
