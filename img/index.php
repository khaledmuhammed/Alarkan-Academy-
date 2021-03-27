<?php
  require_once "core.php";
  require_once "session.php";
  
  switch($_SESSION['user_type']) {
      // Admin
        case '1':
          header('Location:admin/index.php');
          break;
      // student affairs
        case '2':
          header('Location:sa/index.php');
          break;
      // safe
        case '3':
          header('Location:safe/index.php');
          break;
      // customer service
        case '4':
          header('Location:cs/index.php');
          break;
        // Form Officer
        case '5':
        header('Location:officer/index.php');
        break;
      // Back to Index [Login] If something wrong
        default:
          header('Location:index.php');
          break;
  }
