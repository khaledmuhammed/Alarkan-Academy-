<?php

// Start Session IF Not.
!isset($_SESSION) ? session_start() : '';
// If there is no logged user return to login page
isset($_SESSION['username']) ? '' : exit("<script>document.location='./login.php';</script>");
