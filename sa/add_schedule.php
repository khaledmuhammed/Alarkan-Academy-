<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 2 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
require_once '../includes/template/header.php';
require_once 'sidebar.php';
// require_once '../includes/template/sidebar.php';
?>
<link rel="stylesheet" href="../includes/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../includes/plugins/timepicker/bootstrap-timepicker.min.js"></script>


<div class="content-wrapper p-3">

    <section class="content container-fluid">
        <?= saClass::studentschedulesForm(); ?>
    </section>

</div>

<?php require_once '../includes/template/footer.php'; ?>