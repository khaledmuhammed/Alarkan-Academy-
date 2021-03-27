<?php
  require_once "core.php";
  isset($_SESSION['username']) ? exit("<script>document.location='index.php';</script>") : '';
?>

  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Academia</title>
      
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- bootstrap -->
      <link rel="stylesheet" href="includes/plugins/bootstrap/css/bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="includes/css/adminlte.min.css">
      <!-- animate -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"/>
      

      <!-- JQuery -->
      <script src="includes/plugins/jquery/jquery.min.js"></script> 
      <!-- bootstrap -->
      <script src="includes/plugins/bootstrap/js/bootstrap.min.js"></script> 
      <!-- notify -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/mouse0270-bootstrap-notify/3.1.7/bootstrap-notify.min.js"></script>
      <!-- select2 -->
      <script src="includes/plugins/select2/select2.min.js"></script>
      <!-- Core JS -->
      <script src="includes/js/core.js"></script>

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// '-->
      <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body class="hold-transition login-page">
      <div class="login-box">
        <div class="login-logo"> <a href="#"><b>Academia</b></a> </div>
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to log into Academia App!</p>
            <?= user::loginForm();?>
          </div>
        </div>
      </div>
    </body>
  </html>

