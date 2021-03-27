<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 3 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
require_once '../includes/template/header.php';
require_once 'sidebar.php';
// require_once '../includes/template/sidebar.php';
$barCode = (isset($_POST['barCode'])) ? $_POST['barCode'] : NULL ;
// $sub = (isset($_POST['subjects'])) ? $_POST['subjects'] : NULL ;
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
        <?=safeClass::secoundRoundForm($barCode) ; ?>
    </section>
</div>

<?php require_once '../includes/template/footer.php'; ?>
