
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
            
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-file-text-o"></i>
                <p>التقارير<i class="right fa fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add_student.php" class="nav-link">
                    <i class="fa fa-angle-double-right nav-icon"></i>
                    <p>report-name.php</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="find_student.php" class="nav-link">
                    <i class="fa fa-angle-double-right nav-icon"></i>
                    <p>report-name.php</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="find_student.php" class="nav-link">
                    <i class="fa fa-angle-double-right nav-icon"></i>
                    <p>report-name.php</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>الطلبة<i class="right fa fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add_student.php" class="nav-link">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>إضافة طالب</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="find_student.php" class="nav-link">
                    <i class="fa fa-search nav-icon"></i>
                    <p>بحث عن طالب</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="add_student_group.php" class="nav-link">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>تحديد مجموعات الطلبة</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="student_groups.php" class="nav-link">
                    <i class="nav-icon fa fa-users"></i>
                    <p> سجل مجموعات الطلبة</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-check-square-o"></i>
                <p>النتيجة<i class="right fa fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add_results.php" class="nav-link">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>إضافة نتيجة</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-money"></i>
                <p>المرتبات<i class="right fa fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="salary-history.php" class="nav-link">
                    <i class="fa fa-history nav-icon"></i>
                    <p>التواريخ</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="salary-calculate.php" class="nav-link">
                    <i class="fa fa-calculator nav-icon"></i>
                    <p>حساب</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="salary-request.php" class="nav-link">
                    <i class="fa fa-plus nav-icon"></i>
                    <p>تقديم طلب</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="pay_for.php" class="nav-link">
                <i class="nav-icon fa fa-hand-pointer-o text-light" style="font-size: 0.99rem;"></i>
                <p>الطلبات</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="employee.php" class="nav-link">
                <i class="nav-icon fa fa-cog text-light" style="font-size: 0.99rem;"></i>
                <p>الموظفين</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="make_borrow.php" class="nav-link">
                <i class="nav-icon fa fa-black-tie text-light" style="font-size: 0.99rem;"></i>
                <p>طلبات السلف</p>
              </a>
            </li>


        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>