<?php
ob_start();
define('ABSPATH', 'alumni');
require('head.php');
require('meni2.php');
require('meni.php');
if (!isset($_SESSION['status'])){
        header('Location: index.php');
    }
?>

<div class="container min_visina">
<div class="responzive_registracija">
		<br>
		<br>
<?php

if (isset($_GET['poruka']) && $_GET['poruka']=='uspesno') {
#PORUKE - USPESNO_DODAT_DOGADJAJ
	echo '<div class="alert alert-dismissible alert-success">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Uspešno ste dodali dogadjaj.</strong>
			</div>';
}

   $abc = $naslovdogadjaja = $tekstdogadjaja = $rez = $datum = $adminid = $greska = $poslato = $greska_broj= "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['posalji']))
{
 
  if (isset($_POST['abc'])) {
        $abc = test_input($_POST['abc']);
  }
  else
  {
    $greska = "da";
    echo $greska_poruka;
  }

  if (isset($_POST['naslovdogadjaja'])) {
        $naslovdogadjaja = test_input($_POST['naslovdogadjaja']);
  }
  else
  {
    $greska_ime = "has-error";
    $greska = "da";
    echo $greska_poruka;
  }

  if (isset($_POST['naslovdogadjaja'])) {
        $tekstdogadjaja = test_input($_POST['tekstdogadjaja']);
  }
  else
  {
    $greska_ime = "has-error";
    $greska = "da";
    echo $greska_poruka;
  }

  if (isset($_POST['rez'])) {
    $rez = md5($_POST['rez']);
  }
  else
  {
    $greska_ime = "has-error";
    $greska = "da";
    echo $greska_poruka;
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

  if (is_uploaded_file($slika_tmp_ime)) {
### PORUKE - PREVELIKA_SLIKA
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
//Reimenujemo sliku na random generisan naziv
      $alernativno_ime = md5(mt_rand(1,1000)).".".$dozvoljeni_formati[$slika_mime_tip];
      move_uploaded_file($slika_tmp_ime, "img/".$alernativno_ime);
      $slika = $alernativno_ime;
    }
  }
  else
  {
    $slika = "";
  }
  }
}
else
{
  $slika = "";
}

  $datum = date('Y-m-d');

  $adminid = $_SESSION['id'];

  if ($abc==$rez) {
    if ($greska=="") {
      require('config.php');
      require('dbcon.php');
      $query = mysqli_query($con, "INSERT INTO objava (adminid, naslovobjave, tekstobjave, datumobjave, slikaobjave) VALUES ('$adminid', '$naslovdogadjaja', '$tekstdogadjaja', '$datum', '$slika')");

##Slanje Emaila sa tekstom objave onima koji su čekirali da žele da dobiju novosti.
/*
      $subject = $naslovdogadjaja;
      $message = $tekstdogadjaja;

##Posle "From:" ide email od admina i brišu se "/ * * /" tegovi.
      $headers = 'From: boldizar.santo@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

      $query = "SELECT * FROM korisnik WHERE novosti='da'";
      $query_result = $con->query($query);
      while ($rows = mysqli_fetch_array($query_result))
      {
          $to = $rows['email'];
          mail($to, $subject, $message, $headers);
      }
*/
      header('Location: dodajdogadjaj.php?poruka=uspesno');
    }
    else
    {
      echo '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Događaj nije objavljen!</strong>
        </div>';
    }
  }
  else
  {
  ### PORUKE - NETACAN_BROJ
  	$poslato = "ne";
  	echo '<div class="alert alert-dismissible alert-danger">
    			<button type="button" class="close" data-dismiss="alert">&times;</button>
    			<strong>Broj koji ste uneli nije tačan! Pokušajte ponovo.</strong>
  			</div>';
    $greska_broj = "greska_broj";
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
    <legend>DODAJ DOGAĐAJ</legend>

    <div class="form-group">
      <label for="naslovdogadjaja" class="col-lg-2 control-label">Naslov događaja</label>
      <div class="col-lg-10 <?php echo $greska_pass; ?>">
        <input type="text" class="form-control" id="naslovdogadjaja" placeholder="Naslov događaja" name="naslovdogadjaja" value="<?php if(isset($_POST['naslovdogadjaja']) && $poslato == "ne"){echo $_POST['naslovdogadjaja'];} ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="tekstdogadjaja" class="col-lg-2 control-label">Tekst dogadjaja</label>
      <div class="col-lg-10 <?php echo $greska_tekstdogadjaja; ?>">
        <textarea type="text" class="form-control" id="tekstdogadjaja" placeholder="Tekst događaja" name="tekstdogadjaja" rows="8" required><?php if(isset($_POST['tekstdogadjaja']) && $poslato == "ne"){echo $_POST['tekstdogadjaja'];} ?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="slika" class="col-lg-2 control-label">Slika objave</label>
      <div class="col-lg-10 <?php echo $greska_slika; ?>">
        <input type="file" class="form-control" id="slika" name="slika">
        <span class="help-block">Dozvoljeni formati su JPG i PNG maks. 2MB, dimenzije 1x1.</span>
      </div>
    </div>

	 <div class="form-group">
      <label for="rezultat" class="col-lg-2 control-label">Unesiti rezultat</label>
      <div class="col-lg-10">
        <div class="btn" style="background: grey; color: white;"><?php echo $a; ?></div> + <div class="btn" style="background: grey; color: white;"><?php echo $b; ?></div> = <input id="rezultat" type="text" class="rezultat <?php echo $greska_broj;?>" name="rez" placeholder="Unesite rezultat..." required>
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