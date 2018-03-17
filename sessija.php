<?php
if ( !defined('ABSPATH')) {
	die();
}

session_start();

  if (isset($_SESSION['korisnik'])) 
  {
    $korisnik = $_SESSION['korisnik'];
    $myid = $_SESSION['id'];
  } 
  else
  {
    header('Location:index.php');
  }
?>