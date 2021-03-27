<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 3 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
require_once '../includes/template/header.php';
require_once '../classes/request.php';
require_once 'sidebar.php';
// require_once '../includes/template/sidebar.php';


$sId = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$payId = isset($_GET['pay_id']) && is_numeric($_GET['pay_id']) && $_GET['pay_id'] > 0 ? $_GET['pay_id'] : 0;
//$action = payment::find($payId)['pay_for_id'];
$payId = payment::find($payId)['id'];

?>

<div class="content-wrapper p-3">

    <section class="content container-fluid">
        <?= requestClass::getRequest($sId,$payId); ?>
    </section>

</div>

<?php require_once '../includes/template/footer.php'; ?>