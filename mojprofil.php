<?php
ob_start();
define('ABSPATH', 'alumni');
require('head.php');
require('meni2.php');
require('meni.php');

if (isset($_SESSION['id'])) {
	$id = $_SESSION['id'];

	require('config.php');
	require('dbcon.php');

		$query = "SELECT * FROM korisnik WHERE idkorisnika = '$id'";
		$query_result = $con->query($query);
		$rows = mysqli_fetch_array($query_result);

		$ime = $rows['ime'] . " " . $rows['prezime'];
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

?>
<div class="container min_visina">

<?php
  if (isset($_SESSION['profil']) && $_SESSION['profil']=="AZURIRAN") {
    echo '<br><div class="alert alert-dismissible alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          Uspešno ste ažurirali svoj profil.
          </div>';
    unset($_SESSION['profil']);
  }
?>
<br class="tablet-hide">
<div class="row paddb-32">
    <div class="col-sm-4">
    <h3 class="tablet-show ime"><?php echo $ime ?></h3>
		<br>
    <center>
    	<img class="profilna_slika  zabranjen_pristup" src="<?php echo $slika; ?>" alt="<?php echo $ime;?>">
    </center>
    </div>
    <br>
    <div class="col-sm-8">
	<h3 class="tablet-hide ime"><?php echo $ime ?></h3>
		<br>
		<table class="table table-striped table-hover">
		  <tbody>
		    <tr>
		      <td>Smer:</td>
		      <td><?php echo $smer; ?></td>
		    </tr>
		    <tr>
		      <td>Nivo studija:</td>
		      <td><?php echo $nivostud; ?></td>
		    </tr>
		    <tr> 
		      <td>Godina diplomiranja:</td>
		      <td><?php echo $godina; ?></td>
		    </tr>
		    <tr>
		      <td>Naziv Firme:</td>
		      <td><?php echo $firma; ?></td>
		    </tr>
		    <tr>
		      <td>Radno mesto:</td>
		      <td><?php echo $radnomesto; ?></td>
		    </tr>
		  </tbody>
		</table> 
	<a class="btn btn-primary" href="izmeni_profil.php">Izmeni profil</a>
    </div>
  </div>

<?php echo $biografija; ?>
<br>
<br>
<div class="paddb-32 citat">
	<blockquote>
	  <p><?php echo $poruka; ?></p>
	  <small><cite class="ime" title="<?php echo $ime; ?>"><?php echo $ime; ?></cite></small>
	</blockquote>
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