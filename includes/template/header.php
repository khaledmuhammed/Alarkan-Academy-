<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Academia - Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../includes/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- bootstrap -->
  <link rel="stylesheet" href="../includes/plugins/bootstrap/css/bootstrap.min.css">
  <?php
    if (isset($template['header'])) {
      foreach($template['header'] as $val) {
        echo $val;
      }
    }
  ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="../includes/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../includes/plugins/iCheck/flat/blue.css">
  <!-- animate -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"/>
  <!-- select2 -->
  <link href="../includes/plugins/select2/select2.min.css" rel="stylesheet" />
  <!-- bootstrap-wysihtml5 -->
  <link rel="stylesheet" href="../includes/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


<!-- REQUIRED JS SCRIPTS -->
    <!-- JQuery -->
    <script src="../includes/plugins/jquery/jquery.min.js"></script> 
    <!-- bootstrap -->
    <script src="../includes/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <!-- bootstrap-wysihtml5 -->
    <script src="../includes/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> 
    <!-- notify -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.7/bootstrap-notify.min.js"></script>
    <!-- select2 -->
    <script src="../includes/plugins/select2/select2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../includes/js/adminlte.min.js"></script>
    <!-- Core JS -->
    <script src="../includes/js/core.js"></script>
<!-- ----------------------- -->

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

      <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto"> 
      <li class="nav-item">
          <a href="../logout.php" class="d-block nav-link">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->