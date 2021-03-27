<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 3 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
$template = [
    'header' => [
        '<!-- DataTables -->
        <link rel="stylesheet" href="../includes/plugins/datatables/dataTables.bootstrap4.css">'
    ],
    'footer' => [
        '<!-- DataTables -->
        <script src="../includes/plugins/datatables/jquery.dataTables.js"></script>
        <script src="../includes/plugins/datatables/dataTables.bootstrap4.js"></script>'
    ],
    'script' => [
        '<script>
            $(function () {
                $("#students").DataTable({
                    "columns": [
                        {"data": "id"},
                        {"data": "name"},
                        {"data": "action"}
                    ],
            
                    "ordering": false,
                    "lengthMenu": [ 10, 25, 50, 100],
                    "processing": true,
                    "serverSide": true,
            
                    "ajax": {
                        url: "../ajx/student.php",
                        type: "POST",
                        data: {"action":"getStudents"}
                    }
                });
            });
        </script>'
    ]
];
require_once 'sidebar.php';
require_once '../includes/template/header.php';
require_once '../includes/template/sidebar.php';
?>

<div class="content-wrapper p-3">
    <section class="content container-fluid">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title" style="text-transform: capitalize;"> Students
                <div class="form-inline float-right">
                    <a href="find_student.php" class="btn btn-success btn-sm"> <i class="fa fa-search"></i> &nbsp; Find Student</a>
                </div>
                </h3>
            </div>
            <div class="card-body">
                <table id="students" class="table table-bordered table-hover table-responsive w-100 d-block d-md-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</div>

<?php require_once '../includes/template/footer.php'; ?>