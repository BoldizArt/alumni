<?php
ob_start();
session_start();
define('ABSPATH', 'alumni');

require('function.php');

$email = $pass = "";

if (isset($_POST['ulogovanje'])){
  $email = test_input($_POST["email"]);
  $pass = test_input($_POST["pass"]);
  $pass = md5($pass);

  require('config.php');
  require('dbcon.php');

$query = "SELECT * FROM korisnik WHERE email='$email' AND pass='$pass'";

$query_result = $con->query($query);

$rows = mysqli_num_rows($query_result);
$info = mysqli_fetch_array($query_result);

if ($rows > 0) {
  $idkorisnika = $info['idkorisnika'];
  $ime = $info['ime'];
  $prezime = $info['prezime'];
  $email = $info['email'];
  $status = $info['status'];

require('kolacic.php');
  $_SESSION['korisnik'] = $ime . " " . $prezime;
  $_SESSION['id'] = $idkorisnika;
  $_SESSION['status'] = $status;
  $ime=$_SESSION['korisnik']; 

  header("Location: index.php");
}
else
{
$email = test_input($_POST["email"]);
$query = "SELECT * FROM korisnik WHERE email='".$email."'";

$query_result = $con->query($query); 

$rows = mysqli_num_rows($query_result);
$info = mysqli_fetch_array($query_result);

if ($email != $info['email']) {
  header('Location: registracija.php?poruka=email');
}
else
{
  header('Location: greska.php?poruka=pass');
}
  
}
}

?>