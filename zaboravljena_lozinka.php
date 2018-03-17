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

 if (isset($_SESSION['email_nepostoji']) && $_SESSION['email_nepostoji']=="NEPOSTOJI") {
    echo '<div class="alert alert-dismissible alert-danger message_div">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Email adresa koju ste uneli, ne postoji u baze podataka! Ako ste zaboravili vašu email adresu, <a style="text-decoration: underline;" class="alert-link" href="kontakt.php">kontaktirajte admina</a>.</strong>
      </div>';
    unset($_SESSION['email_nepostoji']);
  }
  elseif (isset($_SESSION['nova_lozinka']) && $_SESSION['nova_lozinka']=="NIJE_POSLATA") {
    echo '<div class="alert alert-dismissible alert-danger message_div">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Nismo mogli da vam pošaljemo novu lozinku! Pokušajte kasnije, ili <a style="text-decoration: underline;" class="alert-link" href="kontakt.php">kontaktirajte admina</a>.</strong>
      </div>';
    unset($_SESSION['nova_lozinka']);
  }
  elseif (isset($_SESSION['nova_lozinka']) && $_SESSION['nova_lozinka']=="POSLATA") {
    echo '<div class="alert alert-dismissible alert-success message_div">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>' . PROMENA_LOZINKE_USPESNA . '</strong>
      </div>';
    unset($_SESSION['nova_lozinka']);
    header("Refresh:9; url=index.php");
  }
?>

<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars('reset.php');?>">

  <fieldset>
    <legend>RESETOVANJE LOZINKE</legend>
    <div class="form-group">
      <label for="email" class="col-lg-2 control-label">Email adresa</label>
      <div class="col-lg-10 <?php echo $greska_email; ?>">
        <input type="email" class="form-control" id="email" placeholder="Email adresa" value="<?php if(isset($email_error) && $email_error != "da"){echo isset($_POST['email2'])?$_POST['email2']:"";} ?>" name="email" required>
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