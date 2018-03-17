</body>

<?php

if ( !defined('ABSPATH')) {
  die();
}
?>

<footer class="footer">
	<div class="fluid-container paddtb-32">
		Copyright &#x24B8; 2017 
<?php 
	$trenutna_godina = date('Y'); 
	if ($trenutna_godina>"2017") {
			echo " - " . $trenutna_godina;
	}
?> | <a href="tfzr_alumni_tim.php">TFZR_Alumni Tim</a> 
		<a href="#"><span class="foo_btn">&#x276e;</span></a>
	</div>

</footer>
</html>