<?php

define('system_app', true);

require '../../init.php';

if($app['pmc']['installed'] == true && isset($_SESSION['app']))
    redirect('app/system/dashboard.php');

$page['title']="phpMyCore | ". site_name;

require 'tpl/head.php';

?>
  <body>
  <?php if($app['pmc']['installed'] == true): //require 'tpl/sidebar.php'; require 'tpl/header.php'; ?>
      <div class="row min-h-fullscreen center-vh p-20 m-0">
      <div class="col-12">
        <div class="card card-shadowed px-50 py-30 w-400px mx-auto" style="max-width: 100%">
          <center><h5>phpMyCore | Web Manager</h5></center>
          <!-- class="text-uppercase" -->
          <br>
          <?php /*if(isset($app['error'])): ?>
          <div class="alert alert-danger" role="alert"><?= $app['error']; ?></div>
          <?php endif;*/ ?>

          <form method="post" action="" class="form-type-material">
            <div class="form-group">
              <input type="text" class="form-control" id="username" name="user" required>
              <label for="username">Username</label>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" id="password" name="pass" required>
              <label for="password">Password</label>
            </div>

            <!-- <div class="form-group flexbox flex-column flex-md-row">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked>
                <label class="custom-control-label">Remember me</label>
              </div>

              <a class="text-muted hover-primary fs-13 mt-2 mt-md-0" href="#">Forgot password?</a>
            </div> -->

            <div class="form-group">
              <button class="btn btn-bold btn-block btn-primary" type="submit" name="login">Login</button>
            </div>
          </form>

          <!-- <div class="divider">Or Sign In With</div>
          <div class="text-center">
            <a class="btn btn-square btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
            <a class="btn btn-square btn-google" href="#"><i class="fa fa-google"></i></a>
            <a class="btn btn-square btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
          </div> -->
        </div>
        <!-- <p class="text-center text-muted fs-13 mt-20">Don't have an account? <a class="text-primary fw-500" href="#">Sign up</a></p> -->
      </div>

      <?php require 'tpl/login-footer.php'; ?>

    </div>
    <?php else: ?>
    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>
    
    
    <!-- Main Setup -->
    <main id="setup" class="main-container">

      <div class="main-content">

        <div class="row">

          <div class="col-12 text-center">
            <br><br>
            <h1 class="text-primary font-dosis fw-500 ls-2 display-4">Welcome to phpMyCore</h1>
            <br>
            <h2 class="font-dosis fw-300">Start developing your proyects!</h2>
            <br>
            <p class="lead fw-400 opacity-60">PMC (phpMyCore) Framework was developed with the intention of meeting the basic needs of every good programmer.</p>
            <button class="btn btn-primary" data-provide="loader" data-url="tpl/install.php" data-target="#setup" data-spinner="&lt;div class=&quot;spinner-circle mx-auto&quot;&gt;&lt;/div&gt;">INSTALL NOW</button>
          </div>

        </div>
        
      </div><!--/.main-content -->

      <?php require 'tpl/footer.php'; ?>

    </main>
    <?php endif; require 'tpl/scripts.php'; ?>

  </body>
</html>
