<?php

  if ( !defined('ABSPATH')) {
  die();
  }

  session_start();

  if (isset($_SESSION['korisnik'])) 
  {
    $korisnik = $_SESSION['korisnik'];
    $hide = "";
    $hide2 = "display:none!important";
  } 
  else
  {
    $korisnik = "";
    $hide = "hide";
    $hide2 = "";
  }

  if (isset($_SESSION['status']) && $_SESSION['status']=="admin")
  {
    $hide3 = "";
  } 
  else
  {
    $hide3 = "hide";
  }


if (isset($_COOKIE['email'])) 
{
    $cookie_email = $_COOKIE['email'];
} 
else
{
    $cookie_email = "";
}


### Provera unetih podataka za ulogovanje.

require('proveraunosa_klasa.php');

$email = $pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ulogovanje'])){

### Provera teksta pomoću klase "proveraUnosa".
  $provera = new proveraUnosa($_POST["email"]);
  $email = $provera->test_input();

  $provera = new proveraUnosa($_POST["pass"]);
  $pass = $provera->test_input();
  $pass = md5($pass);

require('config.php');
require('dbcon.php');

$query = "SELECT * FROM korisnik WHERE email='".$email."' AND pass='".$pass."'";

$query_result = $con->query($query); 

  if (mysqli_num_rows($query_result)>0) {
    $rows = mysqli_fetch_array($query_result);

    $idkorisnika = $rows['idkorisnika'];
    $ime = $rows['ime'];
    $prezime = $rows['prezime'];
    $email = $rows['email'];
    $status = $rows['status'];

    if ($status == "odobreno" || $status == "admin")
    {
      require('kolacic.php');
###
  ###
    ### Potrebno je izmeniti ime sessije na random generisano ime.
        $_SESSION['korisnik'] = $ime . " " . $prezime;
        $_SESSION['id'] = $idkorisnika;
        $_SESSION['status'] = $status;
        header("Location: index.php");
    }
    elseif ($status == "odbaceno")
    {
      $_SESSION['osoba_odbacena'] = "ODBACENO";
      header("Location: greska.php");
    }
    else
    {
      $_SESSION['osoba_na_cekanju'] = "NA_CEKANJU";
      header("Location: greska.php");
    }

  }
  else
  {
  $provera = new proveraUnosa($_POST["email"]);
  $email = $provera->test_input();

  $query = "SELECT * FROM korisnik WHERE email='".$email."'";
  $query_result = $con->query($query);

    if (mysqli_num_rows($query_result)>0) {
      $_SESSION['greska_pass']="GRESKA";
      header('Location: greska.php');
    }
    else
    {
      $_SESSION['greska_mail']="GRESKA";
      header('Location: registracija.php');
    }
  }
}

?>

<div class="meni">

  <a style="<?php echo $hide2; ?>" href="http://tfzr.rs/alumni/" class="stari_sajt tablet-hide">Stari Alumni sajt... </a>
<!-- Modal dugme -->
  <a style="<?php echo $hide2; ?>" href="#" class="ulogovanje mright20 mobile-hide" data-toggle="modal" data-target="#myModal">Prijava</a>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <br><br><br><br><br><br>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Prijavite se!</h4>
        </div>
        <div class="modal-body">
          <form class="regi" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <center>
          <br><br>
          <p>
            <input class="inp" type="email" name="email" value="<?php echo $cookie_email; ?>" placeholder="Email adresa" required>
          </p>
          <p>
            <input class="inp" type="password" name="pass" placeholder="Šifra" required>
          </p>
          <p>
            <input type="submit" name="ulogovanje" value="OK" class="btn">
          </p>
          <p>
          <a href="zaboravljena_lozinka.php">Zaboravljena lozinka</a>
          </p>
          </center>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Odbaci</button>
        </div>
      </div>
      
    </div>
  </div>

	<a style="<?php echo $hide2; ?>" href="registracija.php" class="ulogovanje mright20 mobile-hide <?php if (isset($active) && $active=='registracija'){echo 'regiactive';} ?>">Registracija</a>
	
  <div class="pretraga full ui-widget">
		<form action="search.php" method="POST">
			<input class="full" type="search" name="search" id="tags" placeholder="Pretraga">
      <input class="mobile-hide regiactive" type="submit" value="ok">
		</form>
	</div>
</div>
<div class="clear"></div>
<nav class="navbar navbar-default">
  <div class="container-fluid">

<a class="downl tablet-hide" href="downloads/postdiplomci.pdf" target="_blank">
  <div class="downl_f" title="Skini spisak studenata u PDF formatu">
    <i class="fa fa-arrow-circle-o-down"></i>
  </div>
</a>