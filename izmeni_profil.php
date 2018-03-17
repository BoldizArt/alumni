<?php
ob_start();
define('ABSPATH', 'alumni');
require('head.php');
require('meni2.php');
require('meni.php');
require('proverasmerova_klasa.php');

?>
  <div class="container min_visina">
<?php

if (isset($_SESSION['id'])) {
	$id = $_SESSION['id'];

	require('config.php');
	require('dbcon.php');

		$query = "SELECT * FROM korisnik WHERE idkorisnika = '$id'";
		$query_result = $con->query($query);
		$rows = mysqli_fetch_array($query_result);

		$prezime = $rows['prezime'];
		$ime = $rows['ime'];
		$smer = $rows['smer'];
		$grupa = $rows['grupa'];
		$nivostud = $rows['nivostud'];
		$godina = $rows['godinadipl'];
		$firma = $rows['nazivfirme'];
		$radnomesto = $rows['radnomesto'];
		$slika = $rows['fotografija'];
		$biografija = $rows['biografija'];
		$poruka = $rows['poruka'];
    $status = $rows['status'];
    $email = $rows['email'];
    $lozinka = $rows['pass'];
    $greska = "";

##### Izmena slike

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zakacisliku'])){

  if ($lozinka === md5($_POST['pass'])) {
    $greska = "";
    if($_FILES['slika']['name'] !=""){
  		$slika_pathinformacija = pathinfo($_FILES['slika']['name']);
  		$slika_ekstenzija = $slika_pathinformacija['extension'];
  		$slika_fajlvelicina = $_FILES['slika']['size'];
  		$slika_tmp_ime = $_FILES['slika']['tmp_name'];
  		$slika_dimenzija = getimagesize($slika_tmp_ime);
  		$slika_mime_tip = $slika_dimenzija['mime'];
  		$dozvoljeni_formati = array('image/jpeg' => 'jpg',  'image/gif' => 'gif', 'image/png' => 'png');

  		if (is_uploaded_file($slika_tmp_ime)) {

  			if ($slika_fajlvelicina>2000000) {
  				echo '<div class="alert alert-dismissible alert-danger">
    			<button type="button" class="close" data-dismiss="alert">&times;</button>
    			<strong>Slika koji ste postavili je prevelik! Ne sme da bude veći od 2MB!</strong>
  			</div>';
  			$greska_slika = "has-error";
  			$greska = "da";
  			}
  			elseif (!in_array($slika_ekstenzija,$dozvoljeni_formati) || !isset($dozvoljeni_formati[$slika_mime_tip])) {
  				echo '<div class="alert alert-dismissible alert-danger">
    			<button type="button" class="close" data-dismiss="alert">&times;</button>
    			<strong>Postavili ste nedozvoljeni fajl format!</strong>
  			</div>';
  			$greska_slika = "has-error";
  			$greska = "da";
  			}
  			elseif ($slika_dimenzija[0]!=$slika_dimenzija[1]) {
  				echo '<div class="alert alert-dismissible alert-danger">
    			<button type="button" class="close" data-dismiss="alert">&times;</button>
    			<strong>Zbog izgleda, slika mora da bude iste širine i dužine! Ukoliko želite ovu sliku da postavite, kliknite <a href="https://www.befunky.com/create/crop-photo/" class="alert-link" target="_blank">ovde</a> kako bi sekli na odgovarajuće dimenzije (1x1).</strong>
  			</div>';
  			$greska_slika = "has-error";
  			$greska = "da";
  			}
  			else
  			{
  			//Reimenujemo sliku na random generisan naziv
  			$alernativno_ime = md5(mt_rand(1,1000)).".".$dozvoljeni_formati[$slika_mime_tip];
  			move_uploaded_file($slika_tmp_ime, "img/".$alernativno_ime);
  			$slika = "img/".$alernativno_ime;
        $query = mysqli_query($con, "UPDATE korisnik SET fotografija='$slika' WHERE idkorisnika='$id'");
        $_SESSION['profil']="AZURIRAN";
        header('Location: mojprofil.php');
/*Update sliku na sliku koju smo zakačili*/

  			}
  		}
  	}
  }
  else
  {
    echo '<br><div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Lozinka koju ste uneli nije tačna!</strong>
      </div>';
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['posalji'])){

  if ($lozinka === md5($_POST['pass'])) {

  if (isset($_POST['novosti'])) {
    $provera = new proveraUnosa($_POST['novosti']);
    $novosti = $provera->test_input();
  } 
  else 
  {
  $novosti = "ne";
  }

  if (isset($_POST['godina'])) {
    $provera = new proveraUnosa($_POST['godina']);
    $godina = $provera->test_input();
  }else
  {
    $greska_godina = "has-error";
    $greska = "da";
    echo $greska_poruka;
  }

  if (isset($_POST['firma'])) {
    $provera = new proveraUnosa($_POST['firma']);
    $firma = $provera->test_input();
  }else
  {
    $greska_firma = "has-error";
    $greska = "da";
    echo $greska_poruka;
  }

  if (isset($_POST['radnomesto'])) {
    $provera = new proveraUnosa($_POST['radnomesto']);
    $radnomesto = $provera->test_input();
  }else
  {
    $greska_radnomesto = "has-error";
    $greska = "da";
    echo $greska_poruka;
  }

  if (isset($_POST['biografija'])) {
    $provera = new proveraUnosa($_POST['biografija']);
    $biografija = $provera->test_input();
  }else
  {
    $greska_biografija = "has-error";
    $greska = "da";
    echo $greska_poruka;
  }

  if (isset($_POST['poruka'])) {
    $provera = new proveraUnosa($_POST['poruka']);
    $poruka = $provera->test_input();
  }
      ###SMEROVI


    if (isset($_POST['smer'])) {
      if ($_POST['smer']=='0') {
        $update = "bez";
      }
      else
      {
        $update = "sa";
        $proverasmerova = new proveraSmerova($_POST['smer']);
        $proverasmerova->test_input();
        $grupa = $proverasmerova->grupa;
        $smer = $proverasmerova->smer;
        $nivostud = $proverasmerova->nivostud;
      }
    }
    else
    {
      $greska_smer = "has-error";
      $greska = "da";
      echo $greska_poruka;
    }

    if ($greska!="da") {

      if ($update=="sa") {
        $query = mysqli_query($con, "UPDATE korisnik SET novosti='$novosti', smer='$smer', grupa='$grupa', nivostud='$nivostud', godinadipl='$godina', nazivfirme='$firma', radnomesto='$radnomesto', biografija='$biografija', poruka='$poruka' WHERE idkorisnika='$id'");
        $_SESSION['profil']="AZURIRAN";
        header('Location: mojprofil.php');
      }
      elseif ($update=="bez") {
        $query = mysqli_query($con, "UPDATE korisnik SET novosti='$novosti', godinadipl='$godina', nazivfirme='$firma', radnomesto='$radnomesto', biografija='$biografija', poruka='$poruka' WHERE idkorisnika='$id'");
        $_SESSION['profil']="AZURIRAN";
        header('Location: mojprofil.php');
      }
    }

  }
  else
  {
    echo '<br><div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Lozinka koju ste uneli nije tačna!</strong>
      </div>';

  }
}

?>

<br class="tablet-hide">
<div class="row paddb-32">
    <div class="col-sm-4">
    <h3 class="tablet-show ime"><?php echo $prezime . " " . $ime ?></h3>
		<br>
    <center>
    	<img src="<?php echo $slika; ?>" alt="<?php echo $ime . " " . $prezime; ?>" class="profilna_slika zabranjen_pristup">
    </center>
    	<br>
    	<br>

<!-- Izmena profilne slike -->

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="slika" class="col-lg-2 control-label">Nova slika</label>
      <div class="col-lg-10 <?php echo $greska_slika; ?>">
        <input value="Zakači novu sliku" type="file" class="form-control" id="slika" name="slika" required>
        <span class="help-block">Dozvoljeni formati su JPG i PNG do 2MB.</span>
      </div>
    </div>
      <div class="form-group">
      <label for="pass" class="col-lg-2 control-label">Lozinka</label>
      <div class="col-lg-10 <?php echo $greska_pass; ?>">
        <input type="password" class="form-control" id="pass" placeholder="Lozinka" name="pass" required>
        <span class="help-block">Upišite vašu lozinku da bi sačuvali izmene.</span>
        <button type="reset" class="btn btn-default">Odbaci</button>
        <input type="submit" value="Zakači" class="btn btn-primary" name="zakacisliku">
      </div>
      </div>
    </form>

    </div>
    <br>
    <div class="col-sm-8">

<!-- Update profila -->

<form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data" method="post">
<input class="hide" type="text" value="<?php echo $abc; ?>" name="abc" readonly>
  <fieldset>
    <legend class="ime"><?php echo $ime . " " . $prezime; ?></legend>

    <div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email adresa</label>
      <div class="col-lg-10 <?php echo $greska_email; ?>">
        <input type="email" class="form-control" id="email" placeholder="Email adresa" value="<?php echo $email; ?>" name="email" readonly>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="da" checked="on" name="novosti"> Pošalji mi novosti na email adresu.
          </label>
        </div>
      </div>
    </div>

	<div class="form-group">
      <label for="select" class="col-lg-2 control-label">Smer</label>
    <div class="col-lg-10 <?php echo $greska_smer; ?>">
      <select class="form-control" id="select" name="smer">
			<option value="0"><?php echo $smer; ?></option>
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
        <select multiple="" name="godina" class="form-control" required>
        <?php
        $datum = date("Y")+1;
        for ($i=1990; $i < $datum; $i++) { 
       	?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>";
        <?php
        }
        ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="firma" class="col-lg-2 control-label">Naziv firme</label>
      <div class="col-lg-10 <?php echo $greska_firma; ?>">
        <input type="text" class="form-control" id="firma" placeholder="Naziv firme" value="<?php echo $firma; ?>" name="firma" required>
      </div>
    </div>

    <div class="form-group">
      <label for="radnomesto" class="col-lg-2 control-label">Radno mesto</label>
      <div class="col-lg-10 <?php echo $greska_radnomesto; ?>">
        <input type="text" class="form-control" id="radnomesto" placeholder="Radno mesto" value="<?php echo $radnomesto; ?>" name="radnomesto" required>
      </div>
    </div>


    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Kratka biografija</label>
      <div class="col-lg-10 <?php echo $greska_biografija; ?>">
        <textarea maxlength="1200" class="form-control" rows="3" id="textArea"  name="biografija" required><?php echo $biografija;?></textarea>
        <span class="help-block">Napišite ukratko Vašu biografiju (maksimalno 1200 karaktera).</span>
      </div>
    </div>

     <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Poruka za buduće studente</label>
      <div class="col-lg-10">
        <textarea maxlength="450" class="form-control" rows="3" id="textArea" name="poruka"><?php echo $poruka; ?></textarea>
        <span class="help-block">Napišite Vaš savet, šta biste preporučili budućim kolegama (maksimalno 450 karaktera).</span>
      </div>
    </div>

    <div class="form-group">
      <label for="pass" class="col-lg-2 control-label">Lozinka</label>
      <div class="col-lg-10 <?php echo $greska_pass; ?>">
        <input type="password" class="form-control" id="pass" placeholder="Lozinka" name="pass" required>
        <span class="help-block">Upišite vašu lozinku da bi sačuvali izmene.</span>
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

</div>

<?php
}
else
{
	header('Location: index.php');
}
require('footer.php');
?>