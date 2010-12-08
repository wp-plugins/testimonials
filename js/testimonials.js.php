<?php
	header("Content-type: text/javascript");
?>
jQuery(function($) {
	
	$('#scrollup').cycle({ 
		fx:     'scrollUp', 
		timeout: <?php echo $_GET['timeout']; ?>, 
		delay:  <?php echo $_GET['speed']; ?> 
	});
	
	
});
	
