<?php
ob_start();
define('ABSPATH', 'alumni');
session_start();
require('proveraunosa_klasa.php');

if (isset($_GET['id']) && isset($_GET['token'])) {
	$provera = new proveraUnosa($_GET['id']);
	$idkorisnika = $provera->test_input();

	$provera = new proveraUnosa($_GET['token']);
	$token = $provera->test_input();
}

if (isset($_POST['posalji'])) {
	$provera = new proveraUnosa($_POST['pass']);
	$pass = $provera->test_input();

	$provera = new proveraUnosa($_POST['pass2']);
	$pass2 = $provera->test_input();

	if (strlen($pass)<=5) {
		$_SESSION['sifra_min6']="NIJE";
		header("Location: update_pass.php?token=$token");
	}
	else
	{
		if ($pass===$pass2) {
			require('config.php');
			require('dbcon.php');
			$pass = md5($pass1);

			$query = mysqli_query($con, "UPDATE korisnik SET pass='$pass',alternativnasifra='' WHERE idkorisnika='$idkorisnika'");
			$_SESSION['pass_promenjen']="OK";
			header("Location: update_pass.php?token=$token");
		}
		else
		{
			$_SESSION['razlicite_sifre']="RAZLICITE";
			header("Location: update_pass.php?token=$token");
		}
	}

	
}

?>