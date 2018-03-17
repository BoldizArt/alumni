<?php
  define('ABSPATH', 'alumni');
  ob_start();
  session_start();

  require('proveraunosa_klasa.php');

  if (isset($_POST['posalji'])) {
    $provera = new proveraUnosa($_POST['email']);
    $email = $provera->test_input();

    if ($email=='') {

    	header('Location: zaboravljena_lozinka.php');
      die();
    }
    else
    {

    require('config.php'); 
    require('dbcon.php');

      $query = "SELECT * FROM korisnik WHERE email='".$email."'";
      $query_result = $con->query($query);

      if (mysqli_num_rows($query_result) > 0)
      {
        $rows = mysqli_fetch_array($query_result);
    	  $userid = $rows['idkorisnika'];
    	  $korisnik = $rows['ime'] . " " . $rows['prezime'];
        $email = $rows['email'];
        $status = $rows['status'];
        $token = sha1(uniqid($korisnik, true));

        if ($status=="odbaceno") {
          $_SESSION['osoba_odbacena']="ODBACENO";
          header('Location: greska.php');
        }
        else
        {

    	  $query = mysqli_query($con, "UPDATE korisnik SET alternativnasifra='$token' WHERE idkorisnika='$userid'");
###
  ###
    ### Ovde treba upisati link do alumni stranice umesto "www.website.com".

        $url = "http://www.website.com/update_pass.php?token=$token";
        $subject = "Resetovanje korisničke lozinke";
        $message = '
          <div>
            <strong>Parametri za resetovanje lozinke korisničkog imena:</strong>: ' . $korisnik . '<br/>
            <strong>Kliknite <a href="'.$url.'"> ovde</a></strong><br/>
          </div>
        ';
        $headers = 'MINE-Version: 1.0' . "/r/n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "/r/n";

        $headers .= 'From: "Alumni tim" <tfzr.alumni@gmail.com>' . "/r/n";

          if(@mail($email, $subject, $message, $headers))
          {
### Proverava da li je email poslata i šalje pruke sa uputstvima preko sesije na "zaboravljena_lozinka.php" stranicu.
            $_SESSION['nova_lozinka']="POSLATA";
            header('Location: zaboravljena_lozinka.php');
            die();
          }
          else
          {
            $_SESSION['nova_lozinka']="NIJE_POSLATA";
            header('Location: zaboravljena_lozinka.php');
          }
        }
      }
      else
      {
        $_SESSION['email_nepostoji']="NEPOSTOJI";
        header('Location: zaboravljena_lozinka.php');
      }
    }
  }
  else
  {
    $_SESSION['nova_lozinka']="NIJE_POSLATA";
    header('Location: zaboravljena_lozinka.php');
  }
?>