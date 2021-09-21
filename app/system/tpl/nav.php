<nav class="sidebar-navigation">
  <ul class="menu menu-sm menu-bordery">
    <li class="menu-item <?= ($page['id'] == 1) ? 'active' : ''; ?>">
      <a class="menu-link" href="dashboard.php">
        <span class="icon ti-home"></span>
        <span class="title">Dashboard</span>
      </a>
    </li>

    <li class="menu-item <?= ($page['id'] == 2) ? 'active' : ''; ?>">
      <a class="menu-link" href="users.php">
        <span class="icon ti-user"></span>
        <span class="title">Users</span>
      </a>
    </li>

    <li class="menu-item <?= ($page['id'] == 3) ? 'active' : ''; ?>">
      <a class="menu-link" href="templates.php">
        <span class="icon ti-layout"></span>
        <span class="title">Templates</span>
      </a>
    </li>

    <li class="menu-item <?= ($page['id'] == 4) ? 'active' : ''; ?>">
      <a class="menu-link" href="router.php">
        <span class="icon ti-briefcase"></span>
        <span class="title">Router</span>
      </a>
    </li>
<!-- 
    <li class="menu-item <?= ($page['id'] == 5) ? 'active' : ''; ?>">
      <a class="menu-link" href="files.php">
        <span class="icon ti-receipt"></span>
        <span class="title">Files</span>
        <span class="badge badge-pill badge-info">2</span> 
      </a>
    </li>
    -->

    <li class="menu-item <?= ($page['id'] == 6) ? 'active' : ''; ?>">
      <a class="menu-link" href="settings.php">
        <span class="icon ti-settings"></span>
        <span class="title">Settings</span>
      </a>
    </li>

  </ul>
</nav>
