<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 2 ? '' : exit("<script>document.location='../login.php';</script>");
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
                        {"data": "name_ar"},
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
require_once 'sidebar.php';
?>

<div class="content-wrapper p-3">
    <section class="content container-fluid">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title" style="text-transform: capitalize;"> Students
                <div class="form-inline float-right">
                    <a href="add_student.php" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> &nbsp; Add Student</a>
                </div>
                </h3>
            </div>
            <div class="card-body">
                <table id="students" class="table table-bordered table-hover table-responsive w-100 d-block d-md-table">
                    <thead>
                    <tr>
                        <th>??????????</th>
                        <th>name</th>
                        <th>??????????</th>
                        <th>????????????</th>
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