<?php
ob_start();
define('ABSPATH', 'alumni');
$active = "kontakt";
require('head.php');
require('meni2.php');
require('meni.php');
?>

<div class="container min_visina">
<div class="responzive_registracija">
		<br>
		<br>
<?php
if (isset($_SESSION['poruka_poslata']) && $_SESSION['poruka_poslata']=='USPESNO_POSLATA') {
### PORUKE - USPESNO_POSLATA
	echo '<div class="alert alert-dismissible alert-success">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Vaša poruka je uspešno poslata! Kontaktiraćemo Vas na <u>' . $_SESSION['kontakt_mail'] . '</u> email adresu u najkraćem mogućem roku.</strong>
			</div>';
  unset($_SESSION['poruka_poslata'], $_SESSION['kontakt_mail']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['posalji']))
{
$abc2 = $_POST['abc'];
$email = $_POST['email'];
$naslov = $_POST['naslov'];
$tekstporuke = $_POST['tekstporuke'];
$rez = md5($_POST['rez']);

if ($abc2==$rez) {

###
  ###
  ### Ovde fali komanda za slanje e-maila.

  $_SESSION['poruka_poslata'] = 'USPESNO_POSLATA';
  $_SESSION['kontakt_mail'] = $email;
	header('Location: kontakt.php');
	$poslato = "da";
	
}
else
{
	$poslato = "ne";
### PORUKE - NETACAN_BROJ
	echo '<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>' . NETACAN_BROJ . '</strong>
			</div>';
}
}

$a = rand(0,19);
$b = rand(0,19);
$rezultat = $a+$b;
$abc = md5($rezultat);
?>


<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" method="post">
	<input class="hide" type="text" value="<?php echo $abc; ?>" name="abc" readonly>
  <fieldset>
    <legend>KONTAKTIRAJTE NAS</legend>
	<div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email adresa</label>
      <div class="col-lg-10 <?php echo $greska_email; ?>">
        <input type="email" class="form-control" id="email" placeholder="Email adresa" value="<?php if(isset($_POST['email']) && $poslato == "ne"){echo $_POST['email'];} ?>" name="email" required>
      </div>
    </div>
    <div class="form-group">
      <label for="naslov" class="col-lg-2 control-label">Naslov poruke</label>
      <div class="col-lg-10 <?php echo $greska_pass; ?>">
        <input type="text" class="form-control" id="naslov" placeholder="Naslov poruke" name="naslov" value="<?php if(isset($_POST['naslov']) && $poslato == "ne"){echo $_POST['naslov'];} ?>" required>
      </div>
    </div>
    <div class="form-group">
      <label for="tekstporuke" class="col-lg-2 control-label">Tekst poruke</label>
      <div class="col-lg-10 <?php echo $greska_tekstporuke; ?>">
        <textarea type="text" class="form-control" id="tekstporuke" placeholder="Tekst poruke" name="tekstporuke" rows="8" required><?php if(isset($_POST['tekstporuke']) && $poslato == "ne"){echo $_POST['tekstporuke'];} ?></textarea>
      </div>
    </div>

	<div class="form-group">
      <label for="rezultat" class="col-lg-2 control-label">Unesiti rezultat</label>
      <div class="col-lg-10 <?php echo $greska_pass; ?>">
        <div class="btn" style="background: grey; color: white;"><?php echo $a; ?></div> + <div class="btn" style="background: grey; color: white;"><?php echo $b; ?></div> = <input id="rezultat" type="text" name="rez" placeholder="Unesite rezultat..." required>
      </div>
    </div>

    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Odbaci</button>
        <input type="submit" name="posalji" class="btn btn-primary" value="Pošalji">
      </div>
    </div>
    
   </fieldset>
</form>

</div>
</div>
<br><br>

<?php
require('footer.php');
?>