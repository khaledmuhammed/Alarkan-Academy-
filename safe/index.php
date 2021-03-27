<?php
require_once '../core.php';
isset($_SESSION['user_type']) && $_SESSION['user_type'] == 3 ? '' : exit("<script>document.location='../login.php';</script>");
require_once '../session.php';
require_once '../classes/request.php';
require_once '../includes/template/header.php';
require_once './sidebar.php';
// require_once '../includes/template/sidebar.php';

exit("<script>document.location='./requests.php';</script>");

 require_once '../includes/template/footer.php'; ?>