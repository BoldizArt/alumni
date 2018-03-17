<!DOCTYPE html>
<html lang="en">
<head>

<?php

if ( !defined('ABSPATH')) {
  die();
}

require('poruke.php');
?>

<!--
	Fajl kreirao: Santo Boldižar
	Godine: 2017
	Kontakt: boldizar.santo@gmail.com
-->

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Alumni - Neki od naših diplomiranih studenata prezentovali su podatke o svojim radnim biografijama, opisali svoja iskustva sa studija i uputili poruke budućim kolegama...</title>

	<meta name="keywords" content="tfzr, fakultet, student, studenti, alumni, alumni zajednica, zrenjanin, osnovne studije, studije, master, master studije, doktorske studije, stari studenti, zaposleni, diplomirani, diploma, znanje, Mihajlo Pupin">
	<meta name="description" content="Gde rade diplomirani studenti tehničkog fakulteta 'Mihajlo pupin' u zrenjaninu? Neki od naših diplomiranih studenata prezentovali su podatke o svojim radnim biografijama, opisali svoja iskustva sa studija i uputili poruke budućim kolegama...">
	<meta name="robots" content="index, follow">
	<meta name="abstract" content="Ovde rade diplomirani studenti tehničkog fakulteta 'Mihajlo pupin'...">
	<meta name="author" content="Santo Boldižar, Lidija Murtin, Viktorija Ekres">
	<meta name="contact" content="boldizar.santo@gmail.com">
	<meta name="copyright" content="www.boldizart.com">
	<meta http-equiv="imagetoolbar" content="yes">
	<meta name="version" content="2.2">

	<link rel="icon" type="image/png" href="ico.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/cyrlatconverter_ignore_list_rs.js"></script>
	<script src="js/cyrlatconverter.js"></script>
	<script src="js/custom.js"></script>

	<style>
		.ime{text-transform: capitalize;}
	</style>

</head>
<body class="CyrLatConvert">

<?php
	if (isset($_GET['jez'])) {
		$jez = $_GET['jez'];
		if ($jez = 'cir') {
			unset($_COOKIE['jezik']);
			setcookie('jezik', 'cir', time() + (86400 * 30), "/");
		} else if ($jez = 'lat') {
			unset($_COOKIE['jezik']);
			setcookie('jezik', 'lat', time() + (86400 * 30), "/");
		}
	}
?>

<script>
$.CyrLatConverter({
  permalink_hash : "on"
});

$.CyrLatConverter('<?php if (isset($_COOKIE['jezik']) && ($_COOKIE['jezik']=='cir' || $_COOKIE['jezik']=='цир')){ echo 'L2C'; } else {echo 'defoult';} ?>');
</script>