<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 3 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
require_once '../includes/template/header.php';
require_once '../classes/expenses.php';
require_once 'sidebar.php';
// require_once '../includes/template/sidebar.php';


$sId = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? $_GET['id'] : 0;
$exId = isset($_GET['ex_id']) && is_numeric($_GET['ex_id']) && $_GET['ex_id'] > 0 ? $_GET['ex_id'] : 0;
//$action = payment::find($payId)['pay_for_id'];
$payId = expenses::find($exId)['id'];

?>

<div class="content-wrapper p-3">

    <section class="content container-fluid">
        <?= expenseClass::getExpenses($sId,$exId); ?>
    </section>

</div>

<?php require_once '../includes/template/footer.php'; ?>