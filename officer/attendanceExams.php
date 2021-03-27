<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 5 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
require_once '../includes/template/header.php';
require_once 'sidebar.php';
// require_once '../includes/template/sidebar.php';
$sub = (isset($_POST['subject'])) ? $_POST['subject'] : NULL ;
$exType = (isset($_POST['exam_type'])) ? $_POST['exam_type'] : NULL ;
?>
<script>
    $(function(){
        // Select2
        $(document).ready(function() {
            $(".select2").select2();
        });
    });
</script>

<div class="content-wrapper p-3">
    <section class="content container-fluid">
        <?=officerClass::examForm($sub,$exType) ; ?>
    </section>
</div>

<?php require_once '../includes/template/footer.php'; ?>
