<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 2 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
require_once '../includes/template/header.php';
require_once 'sidebar.php';
require_once '../includes/template/sidebar.php';

$id = isset($_GET['student']) && is_numeric($_GET['student']) && $_GET['student'] > 0 ? $_GET['student'] : 0;
?>

<div class="content-wrapper p-3">

    <section class="content container-fluid">
        <?= $id != 0 ? student::getStudent($id) : student::findForm(); ?>
    </section>

</div>

<?php require_once '../includes/template/footer.php'; ?>