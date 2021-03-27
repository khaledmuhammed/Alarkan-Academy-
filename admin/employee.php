<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 1 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
require_once '../classes/employee.php';
require_once '../includes/template/header.php';
require_once 'sidebar.php';
// require_once '../includes/template/sidebar.php';
?>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<div class="content-wrapper p-3">
    
    <section class="content container-fluid">
        <?= employeeClass::table()?>
    </section>

</div>

<?php require_once '../includes/template/footer.php'; ?>