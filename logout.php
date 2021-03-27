<?php
    require_once 'core.php';
    require_once 'session.php';
    
    if (isset($_SESSION['username'])) {
        session_destroy();
        exit("<script>document.location='login.php';</script>");
    } 
?>