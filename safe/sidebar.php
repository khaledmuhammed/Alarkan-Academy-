
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
          <a href="./requests.php" class="d-block"><?= ucwords($_SESSION['name']) ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="./addStudent.php" class="nav-link">
                <i class="nav-icon fa fa-hand-pointer-o text-light" style="font-size: 0.99rem;"></i>
                <p>إضافة طالب</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="./addTrainee.php" class="nav-link">
                <i class="nav-icon fa fa-hand-pointer-o text-light" style="font-size: 0.99rem;"></i>
                <p>إضافة متدرب</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./student_payment.php" class="nav-link">
                <i class="nav-icon fa fa-hand-pointer-o text-light" style="font-size: 0.99rem;"></i>
                <p>إضافة مدفوعات</p>
              </a>
            </li>



            <li class="nav-item">
              <a href="./requests.php" class="nav-link">
                <i class="nav-icon fa fa-hand-pointer-o text-light" style="font-size: 0.99rem;"></i>
                <p>الطلبات</p>
              </a>
            </li>
            


            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-file-text-o" style="font-size: 0.99rem;"></i>
                  <p>النفقات<i class="right fa fa-angle-left"></i></p>
                </a>
              <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="./add_expense.php" class="nav-link">
                    <i class="nav-icon fa fa-hand-pointer-o text-light" style="font-size: 0.99rem;"></i>
                    <p>إضافة نفقة</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./student_expenses.php" class="nav-link">
                    <i class="nav-icon fa fa-money text-light" style="font-size: 0.99rem;"></i>
                    <p>نفقات الطلبة</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="employees_expenses.php" class="nav-link">
                    <i class="nav-icon fa fa-money text-light"></i>
                    <p>نفقات الموظفين</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="salaries_expenses.php" class="nav-link">
                    <i class="nav-icon fa fa-money text-light"></i>
                    <p>نفقات المرتبات</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="other_expenses.php" class="nav-link">
                    <i class="nav-icon fa fa-money text-light"></i>
                    <p>نفقات أخرى</p>
                  </a>
                </li>
              </ul>
            </li>



            <li class="nav-item">
              <a href="./safeReport.php" class="nav-link">
                <i class="nav-icon fa fa-file-text-o" style="font-size: 0.99rem;"></i>
                <p>تقرير الخزنة</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="./totalSalaries.php" class="nav-link">
                <i class="nav-icon fa fa-money text-light" style="font-size: 0.99rem;"></i>
                <p>سجل المرتبات</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="./borrowings.php" class="nav-link">
                <i class="nav-icon fa fa-money text-light" style="font-size: 0.99rem;"></i>
                <p>سجل السلف</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./secoundRound.php" class="nav-link">
                <i class="nav-icon fa fa-hand-pointer-o text-light" style="font-size: 0.99rem;"></i>
                <p>طلبات الدور الثاني</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="./confirmSecoundRound.php" class="nav-link">
                <i class="nav-icon fa fa-money text-light" style="font-size: 0.99rem;"></i>
                <p>سجل الدور الثاني</p>
              </a>
            </li>


            

        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>