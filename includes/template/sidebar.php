
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary">

    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../includes/img/avatar.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Academia</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../includes/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= ucwords($_SESSION['name']) ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php
            if (isset($template['sidebar'])) {
              foreach ($template['sidebar'] as $link => $val) {
                ?>
                  <!-- <?=$val['title']?> -->
                    <li class="nav-item">
                      <a href="<?=$link?>.php" class="nav-link">
                        <i class="nav-icon fa <?=$val['icon']?> text-light" style="font-size: 0.99rem;"></i>
                        <p><?=$val['title']?></p>
                      </a>
                    </li>
                <?php
              }
            }
          ?>
      </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>