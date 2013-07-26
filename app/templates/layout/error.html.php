<?php
$app = app();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Skeleton Bullet Application</title>
  <link href="<?php echo $app->url('/assets/styles/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
  <div class="container">

    <!-- Header -->
    <div class="row">
      <div class="span10 offset1">
        <div id="header">
          <h1><a href="/">Skeleton Application</a></h1>
        </div>
      </div>
    </div>

    <!-- Content -->
    <div class="row">
      <div class="span10 offset1">
        <div id="content">
          <?php echo $yield; ?>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="row">
      <div class="span12">
        <div id="footer">
          <p>Copyright Blah blah, Inc. &copy; <?php echo date('Y'); ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScripts -->
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $app->url('assets/scripts/bootstrap.min.js'); ?>"></script>
</body>
</html>
