<?php
require_once '../core.php';
//USER TYPE EDIT
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
                    "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "student_name"
                    },
                    {
                        "data": "expense_for"
                    },
                    {
                        "data": "value"
                    },
                    {
                        "data": "confirm"
                    }
                ],
                    "ordering": false,
                    "lengthMenu": [ 10, 25, 50, 100],
                    "processing": true,
                    "serverSide": true,
            
                    "ajax": {
                        url: "../ajx/expenses.php",
                        type: "POST",
                        data: {"action":"Table"}
                    }
                });
            });
        </script>'
    ]
];

require_once 'sidebar.php';
require_once '../includes/template/header.php';
// require_once '../includes/template/sidebar.php';
?>

<div class="content-wrapper p-3">
    <section class="content container-fluid">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title" style="text-transform: capitalize;"> نفقات الطلبة </h3>
            </div>
            <div class="card-body">
                <table id="students" class="table table-bordered table-hover table-responsive w-100 d-block d-md-table">
                    <thead>
                    <tr>
                    <th>الرقم</th>
                    <th>إسم الطالب</th>
                    <th>نوع النفقة</th>
                    <th>القيمة</th>
                    <th>تأكيد</th>
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