<!DOCTYPE html>
<html lang="en">
  <head>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

	<?php
		echo $this->Html->meta('icon');
    
		echo $this->fetch('meta');
		
    
	?>

  	<!-- Latest compiled and minified CSS -->
  	<link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap.app.css">
  	<!-- Latest compiled and minified JavaScript -->
  	<script src="/js/jquery-1.11.1.min.js"></script>
  	<script src="/js/bootstrap.min.js"></script>
  <?php 
    echo $this->fetch('css');
		echo $this->fetch('script');
  ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <?php echo $this->Element('navigation'); ?>

    <div class="container">
    
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>

    </div><!-- /.container -->
    <div id="footer" class="footer">
      <p class="text-center">Updated by <a href="http://www.yakimawa.gov" target="_blank">City of Yakima ITS</a> from RecordTrac by <!-- <a href="http://codeforamerica.org/2013-partners/oakland/"> -->Code for America 2013 Fellows<!-- </a> --></p>
      <p class="text-center"><a href="http://www.postcode.io/recordtrac" target="_blank">Get the app</a> for your city or <a href="https://github.com/randybondsjr/recordtrac-cakephp" target="_blank"> view project info</a>.</p>
    </div>
  </body>
</html>
