<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TheAdmin - Responsive admin and web application ui kit">
    <meta name="keywords" content="admin, dashboard, web app, sass, ui kit, ui framework, bootstrap">

    <title>Products &mdash; TheAdmin Invoicer</title>

    <!-- Styles -->
    <link href="assets/css/core.min.css" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
    <link rel="icon" href="assets/img/favicon.png">
  </head>

  <body>


    <!-- Preloader -->
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>


    <!-- Sidebar -->
    <aside class="sidebar sidebar-expand-lg sidebar-light sidebar-sm sidebar-color-info">

      <header class="sidebar-header bg-info">
        <span class="logo">
          <a href="index.html"><img src="assets/img/logo-light.png" alt="logo"></a>
        </span>
        <span class="sidebar-toggle-fold"></span>
      </header>

      <nav class="sidebar-navigation">
        <ul class="menu menu-sm menu-bordery">

          <li class="menu-item">
            <a class="menu-link" href="index.html">
              <span class="icon ti-home"></span>
              <span class="title">Dashboard</span>
            </a>
          </li>

          <li class="menu-item">
            <a class="menu-link" href="clients.html">
              <span class="icon ti-user"></span>
              <span class="title">Clients</span>
            </a>
          </li>

          <li class="menu-item active">
            <a class="menu-link" href="products.html">
              <span class="icon ti-briefcase"></span>
              <span class="title">Products</span>
            </a>
          </li>

          <li class="menu-item">
            <a class="menu-link" href="invoices.html">
              <span class="icon ti-receipt"></span>
              <span class="title">Invoices</span>
              <span class="badge badge-pill badge-info">2</span>
            </a>
          </li>

          <li class="menu-item">
            <a class="menu-link" href="settings.html">
              <span class="icon ti-settings"></span>
              <span class="title">Settings</span>
            </a>
          </li>

        </ul>
      </nav>

    </aside>
    <!-- END Sidebar -->



    <!-- Topbar -->
    <header class="topbar">
      <div class="topbar-left">
        <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
        <a class="logo d-lg-none" href="index.html"><img src="assets/img/logo.png" alt="logo"></a>

        <ul class="topbar-btns">

          <!-- Notifications -->
          <li class="dropdown d-none d-lg-block">
            <span class="topbar-btn has-new" data-toggle="dropdown"><i class="ti-bell"></i></span>
            <div class="dropdown-menu">

              <div class="media-list media-list-hover media-list-divided media-list-xs">
                <a class="media media-new" href="#">
                  <span class="avatar bg-success"><i class="ti-user"></i></span>
                  <div class="media-body">
                    <p>New user registered</p>
                    <time datetime="2018-07-14 20:00">Just now</time>
                  </div>
                </a>

                <a class="media" href="#">
                  <span class="avatar bg-info"><i class="ti-shopping-cart"></i></span>
                  <div class="media-body">
                    <p>New order received</p>
                    <time datetime="2018-07-14 20:00">2 min ago</time>
                  </div>
                </a>

                <a class="media" href="#">
                  <span class="avatar bg-warning"><i class="ti-face-sad"></i></span>
                  <div class="media-body">
                    <p>Refund request from <b>Ashlyn Culotta</b></p>
                    <time datetime="2018-07-14 20:00">24 min ago</time>
                  </div>
                </a>

                <a class="media" href="#">
                  <span class="avatar bg-primary"><i class="ti-money"></i></span>
                  <div class="media-body">
                    <p>New payment has made through PayPal</p>
                    <time datetime="2018-07-14 20:00">53 min ago</time>
                  </div>
                </a>
              </div>

              <div class="dropdown-footer">
                <div class="left">
                  <a href="#">Read all notifications</a>
                </div>

                <div class="right">
                  <a href="#" data-provide="tooltip" title="Mark all as read"><i class="fa fa-circle-o"></i></a>
                  <a href="#" data-provide="tooltip" title="Update"><i class="fa fa-repeat"></i></a>
                  <a href="#" data-provide="tooltip" title="Settings"><i class="fa fa-gear"></i></a>
                </div>
              </div>

            </div>
          </li>
          <!-- END Notifications -->

          <!-- Messages -->
          <li class="dropdown d-none d-lg-block">
            <span class="topbar-btn" data-toggle="dropdown"><i class="ti-email"></i></span>
            <div class="dropdown-menu">

              <div class="media-list media-list-divided media-list-hover media-list-xs scrollable" style="height: 290px">
                <a class="media media-new1" href="../../page-app/mailbox-single.html">
                  <span class="avatar status-success">
                    <img src="assets/img/avatar/1.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Maryam Amiri</strong> <time class="float-right" datetime="2018-07-14 20:00">23 min ago</time></p>
                    <p class="text-truncate">Authoritatively exploit resource maximizing technologies before technically.</p>
                  </div>
                </a>

                <a class="media" href="../../page-app/mailbox-single.html">
                  <span class="avatar status-warning">
                    <img src="assets/img/avatar/2.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Hossein Shams</strong> <time class="float-right" datetime="2018-07-14 20:00">48 min ago</time></p>
                    <p class="text-truncate">Continually plagiarize efficient interfaces after bricks-and-clicks niches.</p>
                  </div>
                </a>

                <a class="media" href="../../page-app/mailbox-single.html">
                  <span class="avatar status-dark">
                    <img src="assets/img/avatar/3.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Helen Bennett</strong> <time class="float-right" datetime="2018-07-14 20:00">3 hours ago</time></p>
                    <p class="text-truncate">Objectively underwhelm cross-unit web-readiness before sticky outsourcing.</p>
                  </div>
                </a>

                <a class="media" href="../../page-app/mailbox-single.html">
                  <span class="avatar status-success bg-purple">FT</span>

                  <div class="media-body">
                    <p><strong>Fidel Tonn</strong> <time class="float-right" datetime="2018-07-14 20:00">21 hours ago</time></p>
                    <p class="text-truncate">Interactively innovate transparent relationships with holistic infrastructures.</p>
                  </div>
                </a>

                <a class="media" href="../../page-app/mailbox-single.html">
                  <span class="avatar status-danger">
                    <img src="assets/img/avatar/4.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Freddie Arends</strong> <time class="float-right" datetime="2018-07-14 20:00">Yesterday</time></p>
                    <p class="text-truncate">Collaboratively visualize corporate initiatives for web-enabled value.</p>
                  </div>
                </a>

                <a class="media" href="../../page-app/mailbox-single.html">
                  <span class="avatar status-success">
                    <img src="assets/img/avatar/5.jpg" alt="...">
                  </span>

                  <div class="media-body">
                    <p><strong>Freddie Arends</strong> <time class="float-right" datetime="2018-07-14 20:00">Yesterday</time></p>
                    <p class="text-truncate">Interactively reinvent standards compliant supply chains through next-generation bandwidth.</p>
                  </div>
                </a>
              </div>

              <div class="dropdown-footer">
                <div class="left">
                  <a href="#">Read all messages</a>
                </div>

                <div class="right">
                  <a href="#" data-provide="tooltip" title="Mark all as read"><i class="fa fa-circle-o"></i></a>
                  <a href="#" data-provide="tooltip" title="Settings"><i class="fa fa-gear"></i></a>
                </div>
              </div>

            </div>
          </li>
          <!-- END Messages -->

        </ul>
      </div>

      <div class="topbar-right">

        <ul class="topbar-btns">
          <li class="dropdown">
            <span class="topbar-btn" data-toggle="dropdown"><img class="avatar" src="assets/img/logo-thetheme.png" alt="..."></span>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#"><i class="ti-user"></i> Profile</a>
              <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
              <a class="dropdown-item" href="#"><i class="ti-help"></i> Help</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="ti-power-off"></i> Logout</a>
            </div>
          </li>
        </ul>

        <form class="lookup lookup-circle lookup-right" target="index.html">
          <input type="text" name="s">
        </form>

      </div>
    </header>
    <!-- END Topbar -->



    <!-- Main container -->
    <main class="main-container">


      <div class="main-content">

        <div class="media-list media-list-divided media-list-hover" data-provide="selectall">

          <header class="flexbox align-items-center media-list-header bg-transparent b-0 py-16 pl-20">
            <div class="flexbox align-items-center">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input">
                <label class="custom-control-label"></label>
              </div>

              <span class="divider-line mx-1"></span>

              <div class="dropdown">
                <a class="btn btn-sm dropdown-toggle" data-toggle="dropdown" href="#">Sort by</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Date</a>
                  <a class="dropdown-item" href="#">Name</a>
                  <a class="dropdown-item" href="#">Cost</a>
                  <a class="dropdown-item" href="#">Popular</a>
                </div>
              </div>
            </div>

            <div>
              <div class="lookup lookup-circle lookup-right">
                <input type="text" data-provide="media-search">
              </div>
            </div>
          </header>


          <div class="media-list-body bg-white b-1">

            <div class="media align-items-center">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input">
                <label class="custom-control-label"></label>
              </div>

              <label class="toggler fs-16 pl-12">
                <input type="checkbox" checked>
                <i class="fa fa-star"></i>
              </label>

              <a class="media-body text-truncate" href="#qv-product-details" data-toggle="quickview">
                <h5>Website design</h5>
                <small>Designing a website with about 5 common pages: Home, Services, Portfolio, About, Contact.</small>
              </a>

              <span class="lead text-fade mr-25" title="Balance" data-provide="tooltip">$5,000</span>
            </div>


            <div class="media align-items-center">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input">
                <label class="custom-control-label"></label>
              </div>

              <label class="toggler fs-16 pl-12">
                <input type="checkbox">
                <i class="fa fa-star"></i>
              </label>

              <a class="media-body text-truncate" href="#qv-product-details" data-toggle="quickview">
                <h5>PSD to HTML</h5>
                <small>Converting a photoshop design to valid HTML pages.</small>
              </a>

              <span class="lead text-fade mr-25" title="Balance" data-provide="tooltip">$3,500</span>
            </div>


            <div class="media align-items-center">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input">
                <label class="custom-control-label"></label>
              </div>

              <label class="toggler fs-16 pl-12">
                <input type="checkbox">
                <i class="fa fa-star"></i>
              </label>

              <a class="media-body text-truncate" href="#qv-product-details" data-toggle="quickview">
                <h5>Website re-design</h5>
                <small>Changing UI of an existing website to a brand new design without requiring to change its server-side code.</small>
              </a>

              <span class="lead text-fade mr-25" title="Balance" data-provide="tooltip">$4,500</span>
            </div>


            <div class="media align-items-center">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input">
                <label class="custom-control-label"></label>
              </div>

              <label class="toggler fs-16 pl-12">
                <input type="checkbox" checked>
                <i class="fa fa-star"></i>
              </label>

              <a class="media-body text-truncate" href="#qv-product-details" data-toggle="quickview">
                <h5>UI Kit</h5>
                <small>Developing a complete UI Kit using Bootstrap 4 for your next design.</small>
              </a>

              <span class="lead text-fade mr-25" title="Balance" data-provide="tooltip">$7,000</span>
            </div>


            <div class="media align-items-center">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input">
                <label class="custom-control-label"></label>
              </div>

              <label class="toggler fs-16 pl-12">
                <input type="checkbox">
                <i class="fa fa-star"></i>
              </label>

              <a class="media-body text-truncate" href="#qv-product-details" data-toggle="quickview">
                <h5>Full package</h5>
                <small>Designing a complete set of a startup brand, including logo, header, favicon, email template, landing page, etc.</small>
              </a>

              <span class="lead text-fade mr-25" title="Balance" data-provide="tooltip">$9,900</span>
            </div>



          </div>


          <footer class="flexbox align-items-center py-20">
            <span class="flex-grow text-right text-lighter pr-2">1-10 of 1,853</span>
            <nav>
              <a class="btn btn-sm btn-square disabled" href="#"><i class="ti-angle-left"></i></a>
              <a class="btn btn-sm btn-square" href="#"><i class="ti-angle-right"></i></a>
            </nav>
          </footer>

        </div>


      </div><!--/.main-content -->


      <!-- Footer -->
      <footer class="site-footer">
        <div class="row">
          <div class="col-md-6">
            <p class="text-center text-md-left">Copyright © 2019 <a href="http://thetheme.io/theadmin">TheAdmin</a>. All rights reserved.</p>
          </div>

          <div class="col-md-6">
            <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
              <li class="nav-item">
                <a class="nav-link" href="../help/articles.html">Documentation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../help/faq.html">FAQ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://themeforest.net/item/theadmin-responsive-bootstrap-4-admin-dashboard-webapp-template/20475359?license=regular&open_purchase_for_item_id=20475359&purchasable=source&ref=thethemeio">Purchase Now</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
      <!-- END Footer -->

    </main>
    <!-- END Main container -->





    <div class="fab fab-fixed">
      <a class="btn btn-float btn-primary" href="#qv-product-add" title="New Product" data-provide="tooltip" data-toggle="quickview"><i class="ti-plus"></i></a>
    </div>




    <!-- Quickview - Add product -->
    <div id="qv-product-add" class="quickview quickview-lg">
      <header class="quickview-header">
        <p class="quickview-title lead fw-400">Add new product</p>
        <span class="close"><i class="ti-close"></i></span>
      </header>

      <div class="quickview-body">

        <div class="quickview-block form-type-material">
          <div class="form-group">
            <input type="text" class="form-control">
            <label>Name</label>
          </div>

          <div class="form-group">
            <input type="text" class="form-control">
            <label>Cost</label>
          </div>

          <div class="form-group">
            <textarea class="form-control" rows="5"></textarea>
            <label>Description</label>
          </div>
        </div>

      </div>

      <footer class="p-12 text-right">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview">Cancel</button>
        <button class="btn btn-flat btn-primary" type="submit">Add product</button>
      </footer>
    </div>
    <!-- END Quickview - Add user -->




    <!-- Quickview - Product detail -->
    <div id="qv-product-details" class="quickview quickview-lg">
      <header class="quickview-header">
        <p class="quickview-title lead fw-400">Change product</p>
        <span class="close"><i class="ti-close"></i></span>
      </header>

      <div class="quickview-body">

        <div class="quickview-block form-type-material">
          <div class="form-group">
            <input type="text" class="form-control" value="Web design">
            <label>Name</label>
          </div>

          <div class="form-group">
            <input type="text" class="form-control" value="5000">
            <label>Cost</label>
          </div>

          <div class="form-group">
            <textarea class="form-control" rows="5">Designing a website with about 5 common pages: Home, Services, Portfolio, About, Contact</textarea>
            <label>Description</label>
          </div>
        </div>

      </div>

      <footer class="p-12 flexbox flex-justified">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview">Cancel</button>
        <a class="btn btn-flat btn-danger">Remove</a>
        <button class="btn btn-flat btn-primary" type="submit">Save changes</button>
      </footer>
    </div>
    <!-- END Quickview - Product detail -->



    <!-- Scripts -->
    <script src="assets/js/core.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/script.js"></script>

  </body>
</html>
