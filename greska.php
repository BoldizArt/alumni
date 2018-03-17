<?php
ob_start();
define('ABSPATH', 'alumni');
require('head.php');
require('meni2.php');
require('meni.php');
?>

<div class="container min_visina">
<div class="responzive_registracija">
		<br>
		<br>

<?php
### PORUKE - POGRESNA_SIFRA
if (isset($_SESSION['osoba_odbacena']) && $_SESSION['osoba_odbacena']=="ODBACENO") {
### PORUKE - ODBACEN_KORISNIK
  echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>' . ODBACEN_KORISNIK . ' <a class="alert-link" href="kontakt.php"> klikom ovde</a>.</strong>
      </div>';
  unset($_SESSION['osoba_odbacena']);
}
elseif (isset($_SESSION['osoba_na_cekanju']) && $_SESSION['osoba_na_cekanju']=="NA_CEKANJU") {
### PORUKE - KORISNIK_NA_CEKANJU
  echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>' . KORISNIK_NA_CEKANJU . '</strong>
        </div>';
  unset($_SESSION['osoba_na_cekanju']);
}
elseif (isset($_SESSION['greska_pass']) && $_SESSION['greska_pass']=="GRESKA") {
  echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>' . POGRESNA_SIFRA . ' <a class="alert-link" href="zaboravljena_lozinka.php">zaboravljena lozinka</a>.</strong>
      </div>';
  unset($_SESSION['greska_pass']);
}
?>

<form class="form-horizontal" action="<?php echo htmlspecialchars('prijava.php');?>" method="post">

  <fieldset>
    <legend>PRIJAVA</legend>
	<div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email adresa</label>
      <div class="col-lg-10 <?php echo $greska_email; ?>">
        <input type="email" class="form-control" id="email" placeholder="Email adresa" value="<?php if(isset($email_error) && $email_error != "da"){echo isset($_POST['email2'])?$_POST['email2']:"";} ?>" name="email" required>
      </div>
    </div>
    <div class="form-group">
      <label for="pass" class="col-lg-2 control-label">Lozinka</label>
      <div class="col-lg-10 <?php echo $greska_pass; ?>">
        <input type="password" class="form-control" id="pass" placeholder="Lozinka" name="pass" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="submit" name="ulogovanje" class="btn btn-primary" value="Prijavi se">
        <a href="zaboravljena_lozinka.php" class="btn btn-default">Zaboravljena lozinka</a>
      </div>
    </div>
   </fieldset>
</form>

</div>
</div>

<?php
require('footer.php');
?>