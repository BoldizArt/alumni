<?php
ob_start();
define('ABSPATH', 'alumni');
$active = "registracija";
require('head.php');
require('meni2.php');
require('meni.php');
require('proverasmerova_klasa.php');
?>	

<div class="container margt64">
	<div class="responzive_registracija">

<?php

	$greska = $greska_ime = $greska_prezime = $greska_email = $greska_pass = $greska_smer = $greska_godina = $greska_firma = $greska_radnomesto = $greska_slika = $greska_biografija = $greska_tekstporuke = $greska_rezultat = "";

### PORUKE - SLIKA_NIJE_POSTAVLJENA
	$slika_poruka = '<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>' . SLIKA_NIJE_POSTAVLJENA . '</strong>
			</div>';

### PORUKE - PRAZNO_POLJE
	$greska_poruka = '<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>' . PRAZNO_POLJE . '</strong>
			</div>';

### PORUKE - EMAIL_NEPOSTOJI_NIJE_REGISTROVAN
	if (isset($_SESSION['greska_mail']) && $_SESSION['greska_mail']=="GRESKA") {
		echo '<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>' . EMAIL_NEPOSTOJI_NIJE_REGISTROVAN . '</strong>
			</div>';
		unset($_SESSION['greska_mail']);

		}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['posalji']))
{
	
	$ime = $prezime = $email = $email2 = $pass = $pass2 = $smer = $godina = $firma = $radnomesto = $slika = $biografija = $poruka = $rezultat = $rezultat2 = "";

	require('config.php');
	require('dbcon.php');

### Provera preko klase "proveraUnosa" da li je tekst tekst.

		if (isset($_POST['rezultat'])) {
			$provera = new proveraUnosa($_POST['rezultat']);
			$rezultat = $provera->test_input();
		}

		if (isset($_POST['rezultat2'])) {
			$provera = new proveraUnosa($_POST['rezultat2']);
			$rezultat2 = $provera->test_input();
		}
		else
		{
			$greska_rezultat = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['novosti'])) {
			$provera = new proveraUnosa($_POST['novosti']);
			$novosti = $provera->test_input();
		} 
		else 
		{
		$novosti = "ne";
		}

		if (isset($_POST['ime'])) {
			$provera = new proveraUnosa($_POST['ime']);
			$ime = $provera->test_input();
		}
		else
		{ 
			$greska_ime = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['prezime'])) {
			$provera = new proveraUnosa($_POST['prezime']);
			$prezime = $provera->test_input();
		}
		else
		{ 
			$greska_ime = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['email'])) {
			$provera = new proveraUnosa($_POST['email']);
			$email = $provera->test_input();
		}
		else
		{ 
			$greska_email = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['email2'])) {
			$provera = new proveraUnosa($_POST['email2']);
			$email2 = $provera->test_input();
		}
		else
		{ 
			$greska_email = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['pass'])) {
			$provera = new proveraUnosa($_POST['pass']);
			$pass = $provera->test_input();
		}
		else
		{
			$greska_pass = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['pass2'])) {
			$provera = new proveraUnosa($_POST['pass2']);
			$pass2 = $provera->test_input();
		}
		else
		{
			$greska_pass = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['godina'])) {
			$provera = new proveraUnosa($_POST['godina']);
			$godina = $provera->test_input();
		}
		else
		{
			$greska_godina = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['firma'])) {
			$provera = new proveraUnosa($_POST['firma']);
			$firma = $provera->test_input();
		}
		else
		{
			$greska_firma = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['radnomesto'])) {
			$provera = new proveraUnosa($_POST['radnomesto']);
			$radnomesto = $provera->test_input();
		}
		else
		{
			$greska_radnomesto = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['biografija'])) {
			$provera = new proveraUnosa($_POST['biografija']);
			$biografija = $provera->test_input();
		}
		else
		{
			$greska_biografija = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

		if (isset($_POST['poruka'])) {
			$provera = new proveraUnosa($_POST['poruka']);
			$poruka = $provera->test_input();
		}

			$test_ime = "/^[A-Za-zšđžčćŠĐŽČĆ ]{3,30}$/u";

###SMEROVI
		if (isset($_POST['smer'])) {
			$proverasmerova = new proveraSmerova($_POST['smer']);
			$proverasmerova->test_input();
			$grupa = $proverasmerova->grupa;
			$smer = $proverasmerova->smer;
			$nivostud = $proverasmerova->nivostud;
		}
		else
		{
			$greska_smer = "has-error";
			$greska = "da";
			echo $greska_poruka;
		}

### PORUKE - IME_GRESKA
		if (!preg_match($test_ime, $ime)) {
			echo '<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>' . IME_GRESKA  . '</strong>
			</div>';
		$greska_ime = "has-error";
		$greska = "da";
		}

### PORUKE - PREZIME_GRESKA
			if (!preg_match($test_ime, $prezime)) {
				echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . PREZIME_GRESKA . '</strong>
				</div>';
			$greska_prezime = "has-error";
			$greska = "da";
			}
			else
			{

			}

### PORUKE - RAZLICITI_EMAIL
		if (isset($email)) {
			if ($email !=$email2) {
				echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . RAZLICITI_EMAIL . '</strong>
				</div>';
			$greska_email = "has-error";
			$greska = "da";
			$email_error = "da";
			}
			else
			{
				$query = "SELECT * FROM korisnik WHERE email='".$email."'";
				$query_result = $con->query($query); 

				$rows = mysqli_num_rows($query_result);
				$info = mysqli_fetch_array($query_result);

### PORUKE - EMAIL_POSTOJI
				if ($email == $info['email']) {
				  echo '<div class="alert alert-dismissible alert-danger">
		  			<button type="button" class="close" data-dismiss="alert">&times;</button>
		  			<strong>' . EMAIL_POSTOJI . '<a href="zaboravljena_lozinka.php" class="alert-link">Zaboravljena šifra</a>!</strong>
					</div>';
				$greska_email = "has-error";
				$greska = "da";
				$email_error = "da";
				}
				else
				{
				$email_error = "";
				}
			}
		}
		else
		{
		$email_error = "";
		}

### PORUKE - RAZLICITE_SIFRE
		if (isset($pass)) {
			if ($pass !=$pass2) {
				echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . RAZLICITE_SIFRE .'</strong>
				</div>';
			$greska_pass = "has-error";
			$greska = "da";
			}

### PORUKE - SIFRA_MINIMUM6
			elseif (strlen($pass)<=5) {
				echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . SIFRA_MINIMUM6 . '</strong>
				</div>';
			$greska_pass = "has-error";
			$greska = "da";
			}
			else
			{
			$pass = md5($pass);
			}
		}
		else
		{

		}

### PORUKE - PRAZAN_SMER
		if (isset($_POST['smer'])) {
			if ($_POST['smer'] == "0") {
				echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . PRAZAN_SMER . '</strong>
				</div>';
			$greska_smer = "has-error";
			$greska = "da";
			}
		}

	if(isset($_FILES['slika']['name']) && $_FILES['slika']['name']!=""){

		if($_FILES['slika']['name'] !="" && $greska == ""){

			$slika_pathinformacija = pathinfo($_FILES['slika']['name']);
			$slika_ekstenzija = $slika_pathinformacija['extension'];
			$slika_fajlvelicina = $_FILES['slika']['size'];
			$slika_tmp_ime = $_FILES['slika']['tmp_name'];
			$slika_dimenzija = getimagesize($slika_tmp_ime);
			$slika_mime_tip = $slika_dimenzija['mime'];
			$dozvoljeni_formati = array('image/jpeg' => 'jpg', 'image/png' => 'png');

### PORUKE - PREVELIKA_SLIKA
			if (is_uploaded_file($slika_tmp_ime)) {
				if ($slika_fajlvelicina>2000000) {
					echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . PREVELIKA_SLIKA . '</strong>
				</div>';
				$greska_slika = "has-error";
				$greska = "da";
				}
### PORUKE - NEDOZVOLJENI_FORMAT
				elseif (!in_array($slika_ekstenzija,$dozvoljeni_formati) || !isset($dozvoljeni_formati[$slika_mime_tip])) {
					echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . NEDOZVOLJENI_FORMAT . '</strong>
				</div>';
				$greska_slika = "has-error";
				$greska = "da";
				}
### PORUKE - NEODGOVARAJUCE_DIMENZIJE_SLIKE
				elseif ($slika_dimenzija[0]!=$slika_dimenzija[1]) {
					echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . NEODGOVARAJUCE_DIMENZIJE_SLIKE . '<a href="https://www.befunky.com/create/crop-photo/" class="alert-link" target="_blank">ovde</a> kako bi sekli na odgovarajuće dimenzije (1x1).</strong>
				</div>';
				$greska_slika = "has-error";
				$greska = "da";
				}
				else
				{
### Reimenujemo sliku na random generisan naziv
				$alernativno_ime = md5(mt_rand(1,1000)).".".$dozvoljeni_formati[$slika_mime_tip];
				move_uploaded_file($slika_tmp_ime, "img/".$alernativno_ime);
				$slika = "img/".$alernativno_ime;
				}
			}
			else
			{

			}
		}
	}
	else
	{
		$greska_slika = "has-error";
		$greska = "da";
		echo $slika_poruka;
	}

	if ($rezultat==$rezultat2) {

		if (isset($greska) && $greska == "") {

		$query = mysqli_query($con, "INSERT INTO korisnik (prezime, ime, email, novosti, pass, smer, grupa, nivostud, godinadipl, nazivfirme, radnomesto, fotografija, biografija, poruka, status) VALUES ('$prezime', '$ime', '$email', '$novosti', '$pass', '$smer', '$grupa', '$nivostud', '$godina', '$firma', '$radnomesto', '$slika', '$biografija', '$poruka', 'neodredjeno')");
		
### PORUKE - USPESNA_REGISTRACIJA
			echo '<div class="alert alert-dismissible alert-success">
		  	<button type="button" class="close" data-dismiss="alert">&times;</button>
		  	<strong>' . USPESNA_REGISTRACIJA . '<a href="fantastic3.php" class="alert-link"> TFZR Alumni Tim</a>.
			</div>';
			header("Refresh:9; url=index.php");
		}
		else
		{

		}

	}
	else
	{
### PORUKE - NETACAN_BROJ
		echo '<div class="alert alert-dismissible alert-danger">
	  			<button type="button" class="close" data-dismiss="alert">&times;</button>
	  			<strong>' . NETACAN_BROJ . '</strong>
				</div>';
	}
	}

	$a = rand(5,599);
	$rezultat = md5($a);
	$rezultat = substr($rezultat, 5, 5);
### PORUKE - REGISTRACIJA_PRAVILA
?>

	<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" method="post">
<input class="hide" type="text" value="<?php echo $rezultat; ?>" name="rezultat" readonly>
  <fieldset>
    <legend>REGISTRACIJA</legend>
    <div class="form-group">
      <label for="ime" class="col-lg-2 control-label">Ime</label>
      <div class="col-lg-10 <?php echo $greska_ime; ?>">
        <input type="text" class="form-control" id="ime" placeholder="Ime" value="<?php if (isset($_POST['ime'])) { echo $_POST['ime']; }?>" name="ime" required>
      </div>
    </div>
    <div class="form-group">
      <label for="prezime" class="col-lg-2 control-label">Prezime</label>
      <div class="col-lg-10 <?php echo $greska_prezime; ?>">
        <input type="text" class="form-control" id="prezime" placeholder="Prezime" value="<?php if (isset($_POST['prezime'])) { echo $_POST['prezime']; }?>" name="prezime" required>
      </div>
    </div>

    <div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email adresa</label>
      <div class="col-lg-10 <?php echo $greska_email; ?>">
        <input type="email" class="form-control" id="email" placeholder="Email adresa" value="<?php if(isset($email_error) && $email_error != "da"){if (isset($_POST['email'])) {echo $_POST['email'];}}?>" name="email" required>
      </div>
    </div>

    <div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email adresa ponovo</label>
      <div class="col-lg-10 <?php echo $greska_email; ?>">
        <input type="email" class="form-control" id="email2" placeholder="Email adresa ponovo" name="email2" value="<?php if(isset($email_error) && $email_error != "da"){if (isset($_POST['email2'])) {echo $_POST['email2'];}}?>" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="da" checked="on" name="novosti"> Pošalji mi novosti na email adresu.
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="pass" class="col-lg-2 control-label">Lozinka</label>
      <div class="col-lg-10 <?php echo $greska_pass; ?>">
        <input type="password" class="form-control" id="pass" placeholder="Lozinka" name="pass" required>
        <span class="help-block">Lozinka mora da sastoji od minimum 6 karaktera.</span>
      </div>
    </div>

    <div class="form-group">
      <label for="pass2" class="col-lg-2 control-label">Lozinka ponovo</label>
      <div class="col-lg-10 <?php echo $greska_pass; ?>">
        <input type="password" class="form-control" id="pass2" placeholder="Lozinka ponovo" name="pass2" required>
      </div>
    </div>

	<div class="form-group">
      <label for="select" class="col-lg-2 control-label">Smer</label>
      <div class="col-lg-10 <?php echo $greska_smer; ?>">
        <select class="form-control" id="select" name="smer" required>
			<option value="<?php if (isset($_POST['smer'])){echo $_POST['smer'];}else{echo 0;}?>"><?php if (isset($_POST['smer'])){echo $smer;}else{echo "Izaberite smer...";}?></option>
			<option value="DiPTiO">Dizajn i projektovanje tekstila i odeće</option>
			<option value="DiPTiOM">Dizajn i projektovanje tekstila i odeće - Master</option>
			<option value="IT">Informacione tehnologije</option>
			<option value="ITM">Informacione tehnologije - Master</option>
			<option value="ITSI">Informacione tehnologije - Softversko inženjerstvo</option>
			<option value="ITuEUiPSM">IT u e upravi i poslovnim sistemima - Master</option>
			<option value="ItI">Informatičko inženjerstvo</option>
			<option value="IuO">Informatika u obrazovanju</option>
			<option value="IuOM">Informatika u obrazovanju - Master</option>
			<option value="IiTuO">Informatika i tehnika u obrazovanju</option>
			<option value="IiTuOM">Informatika i tehnika u obrazovanju - Master</option>
			<option value="IM">Inženjerski menadžment</option>
			<option value="IMM">Inženjerski menadžment - Master</option>
			<option value="IMD">Inženjerski menadžment - Doktorske studije</option>
			<option value="IZZS">Inženjerstvo zaštite životne sredine</option>
			<option value="IZZSM">Inženjerstvo zaštite životne sredine - Master</option>
			<option value="II">Industrijsko inženjerstvo</option>
			<option value="IIM">Industrijsko inženjerstvo - Master</option>
			<option value="IIMS">Industrijsko inženjerstvo mašinske struke</option>
			<option value="IIMSM">Industrijsko inženjerstvo mašinske struke - Master</option>
			<option value="IIuENiG">Industrijsko inženjerstvo u eksplotaciji nafte i gasa</option>
			<option value="MI">Mašinsko inženjerstvo</option>
			<option value="MIT">Menadžment informacionih tehnologija</option>
			<option value="MPK">Menadžment poslovnih komunikacija</option>
			<option value="MPKM">Menadžment poslovnih komunikacija - Master</option>
			<option value="OI">Odevno inženjerstvo</option>
			<option value="OIM">Odevno inženjerstvo - Master</option>
			<option value="OT">Odevna tehnologija</option>
			<option value="OTM">Odevna tehnologija - Master</option>
			<option value="PT">Profesor tehnike</option>
			<option value="PTM">Profesor tehnike - Master</option>
			<option value="PTiI">Profesor tehnike i informatike</option>
			<option value="PTiIM">Profesor tehnike i informatike - Master</option>
			<option value="PM">Proizvodni menadžment</option>
			<option value="PMM">Proizvodni menadžment - Master</option>
			<option value="PI">Poslovna informatika</option>
			<option value="PIM">Poslovna informatika - Master</option>
			<option value="UTS">Upravljanje tehničkim sistemima</option>
			<option value="UTSM">Upravljanje tehničkim sistemima - Master</option>
        </select>
       </div>
      </div>

	  <div class="form-group">
	  <label for="select" class="col-lg-2 control-label">Godina diplomiranja</label>
	   <div class="col-lg-10 <?php echo $greska_godina; ?>">

		<?php
    	if (isset($_POST['godina'])) {
    		echo "<input type=\"text\" class=\"form-control\" value=\"" . $_POST['godina'] . "\" name=\"godina\" readonly>";
    	}
    	else
    	{
    		echo "<select multiple=\"\" name=\"godina\" class=\"form-control\" required>";
    	
	        $datum = date("Y")+1;
	        for ($i=1990; $i < $datum; $i++)

			{
				echo "<option value=\"" . $i . "\">". $i . "</option>";
			}
		echo "</select>";
    	}
    	?>
        
      </div>
    </div>
    <div class="form-group">
      <label for="firma" class="col-lg-2 control-label">Naziv firme</label>
      <div class="col-lg-10 <?php echo $greska_firma; ?>">
        <input type="text" class="form-control" id="firma" placeholder="Naziv firme" value="<?php echo isset($_POST['firma'])?$_POST['firma']:""; ?>" name="firma" required>
      </div>
    </div>

    <div class="form-group">
      <label for="radnomesto" class="col-lg-2 control-label">Radno mesto</label>
      <div class="col-lg-10 <?php echo $greska_radnomesto; ?>">
        <input type="text" class="form-control" id="radnomesto" placeholder="Radno mesto" value="<?php echo isset($_POST['radnomesto'])?$_POST['radnomesto']:""; ?>" name="radnomesto" required>
      </div>
    </div>

	<div class="form-group">
      <label for="slika" class="col-lg-2 control-label">Profilna slika</label>
      <div class="col-lg-10 <?php echo $greska_slika; ?>">
        <input type="file" class="form-control" id="slika" name="slika" required>
        <span class="help-block">Dozvoljeni formati su JPG i PNG maks. 2MB, dimenzije 1x1.</span>
      </div>
    </div>


    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Kratka biografija</label>
      <div class="col-lg-10 <?php echo $greska_biografija; ?>">
        <textarea maxlength="1200" class="form-control" rows="3" id="textArea"  name="biografija" required><?php echo isset($_POST['biografija'])?$_POST['biografija']:""; ?></textarea>
        <span class="help-block">Napišite ukratko Vašu biografiju (maksimalno 1200 karaktera).</span>
      </div>
    </div>

     <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Poruka za buduće studente</label>
      <div class="col-lg-10">
        <textarea maxlength="450" class="form-control" rows="3" id="textArea" name="poruka"><?php echo isset($_POST['poruka'])?$_POST['poruka']:""; ?></textarea>
        <span class="help-block">Napišite Vaš savet, šta biste preporučili budućim kolegama (maksimalno 450 karaktera).</span>
      </div>
    </div>
    <div class="form-group">
      <label for="rezultat" class="col-lg-2 control-label">Unesiti rezultat</label>
      <div class="col-lg-10 <?php echo $greska_tekstporuke; ?>">

	<svg width="150" height="50">
	  <defs>
	    <filter id="MyFilter" filterUnits="userSpaceOnUse" x="0" y="0" width="150" height="50">
	      <feGaussianBlur in="SourceAlpha" stdDeviation="2.75" result="blur" />
	      <feOffset in="blur" dx="2" dy="2" result="offsetBlur" />
	    </filter>
	  </defs>
	  
	  <g filter="url(#MyFilter)">
	    <text fill="#FFFFFF" stroke="#4d4d4d" font-size="32" font-family="Arial" x="26" y="38"><?php echo $rezultat; ?></text>
	  </g>
	</svg>
	<br>
	<input id="rezultat" class="form-control <?php echo $greska_rezultat; ?>" type="text" name="rezultat2" placeholder="Unesite rezultat..." required>
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
<br><br><br>

<?php
require('footer.php');
?>