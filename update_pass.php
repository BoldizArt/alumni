
<?php

define('ABSPATH', 'alumni');
ob_start();

require('head.php');
require('meni2.php');
require('meni.php');

if (isset($_SESSION['korisnik'])) {

  header('Location: index.php');
}
?>

<div class="container min_visina">
<div class="responzive_registracija">
    <br>
    <br>

<?php

  if (isset($_SESSION['sifra_min6']) && $_SESSION['sifra_min6']=="NIJE") {
    echo '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>' . SIFRA_MINIMUM6 . '</strong>
          </div>';
    unset($_SESSION['sifra_min6']);
  }

  if (isset($_SESSION['razlicite_sifre']) && $_SESSION['razlicite_sifre']=="RAZLICITE") {
    echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert message_div">&times;</button>
        <strong>' . RAZLICITE_SIFRE . '</strong>
      </div>';
    unset($_SESSION['razlicite_sifre']);
  }

  if (isset($_SESSION['pass_promenjen']) && $_SESSION['pass_promenjen']=="OK") {
      header('Refresh:7; url=index.php');
      unset($_SESSION['pass_promenjen']);
      die('<div class="alert alert-dismissible alert-success message_div">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Uspešno ste promenili lozinku!</strong>
        </div>');
    }

  if (isset($_GET['token']) && preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])) {
    $alternativnasifra = $_GET['token'];
  }
  else
  {
    die('<div class="alert alert-dismissible alert-danger message_div">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Token je neispravan!</strong>
        </div>');
  }

require('config.php');
require('dbcon.php');

  $query = "SELECT * FROM korisnik WHERE alternativnasifra='$alternativnasifra'";
  $query_result = $con->query($query);
  $rows = mysqli_fetch_array($query_result);
  if (mysqli_num_rows($query_result)>0) {

  $idkorisnika = $rows['idkorisnika'];

  $query = "SELECT prezime, ime FROM korisnik WHERE idkorisnika='$idkorisnika'";
  $query_result = $con->query($query);
  $rows = mysqli_fetch_assoc($query_result);
  $ime = $rows['ime'] . " " . $rows['prezime'];
  }
  else
  {
    die('<div class="alert alert-dismissible alert-danger message_div">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Token ne postoji!</strong>
      </div>');
  }

?>

<form class="form-horizontal" method="POST" action="promeni_lozinku.php?id=<?php echo $idkorisnika;?>&token=<?php echo $alternativnasifra;?>">

  <fieldset>
    <legend>RESETOVANJE LOZINKE ZA <span style="text-transform: uppercase; color: #286090"><?php echo $ime; ?></span></legend>

    <div class="form-group">
      <label for="lozinka" class="col-lg-2 control-label">Nova lozinka</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="lozinka" placeholder="Nova lozinka" name="pass" required>
      </div>
    </div>

    <div class="form-group">
      <label for="lozinka2" class="col-lg-2 control-label">Lozinka ponovo</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="lozinka" placeholder="Lozinka ponovo" name="pass2" required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="submit" name="posalji" class="btn btn-primary" value="Pošalji">
      </div>
    </div>
   </fieldset>
</form>


</div>
</div>


<?php
require('footer.php');
?>