<?php 
ob_start(); session_start();
require('dts\dbaSis.php');
require('dts\getSis.php');
require('dts\setSis.php');
require('dts\outSis.php');
viewManager('600');?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="FOTO VIZAM" />
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="robots" content="INDEX,FOLLOW" />
        <meta name="url" content="<?php echo BASE;?>" />
        <meta name="keywords" content="<?php echo SITETAGS;?>" />
        <meta name="description" content="<?php echo SITEDESC;?>" />
        <title><?php echo SITENAME; ?></title>       
        <link rel="stylesheet" href="<?php setHome();?>/style/libraries/bootstrap.css" />
        <link rel="stylesheet" href="<?php setHome();?>/style/libraries/bootstrap-responsive.css" /> 
        <link rel="stylesheet" href="<?php setHome();?>/style/css/all.css" />       
    </head>
    <body>
<?php

 getHome();

?>
</section><!--/container-->
</body>
<script type="text/javascript" src="<?php setHome();?>/style/libraries/jquery.js"></script>
 <script type="text/javascript">
	$('.carousel').carousel({
		auto:true;
		
		});
   }); 
	</script>
<script src="<?php setHome();?>/style/libraries/jquery.elevatezoom.js"></script>
<script>
 $("#zoom_01").elevateZoom({easing : true});

</script>
<script type="text/javascript" src="<?php setHome();?>/style/libraries/bootstrap.js"></script>
<script type="text/javascript" src="<?php setHome();?>/style/scripts/all.js"></script>

<?php ob_end_flush(); ?>
</html>
