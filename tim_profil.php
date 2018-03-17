<?php
ob_start();
define('ABSPATH', 'alumni');
require('head.php');
require('meni2.php');
require('meni.php');
require('proverasmerova_klasa.php');


if (isset($_GET['id'])) {
	$provera = new proveraUnosa($_GET['id']);
    $id = $provera->test_input();

	require('config.php');
	require('dbcon.php');

		$query = "SELECT * FROM alumni_tim WHERE idkorisnika = '$id'";
		$query_result = $con->query($query);
		$rows = mysqli_fetch_array($query_result);
		if($rows<=0){
			header('Location: index.php');
		}

		$ime = $rows['ime'] . " " . $rows['prezime'];
		$pozicija = $rows['pozicija'];
		$nivostud = $rows['nivostud'];
		$email = $rows['email'];
        $website = $rows['website'];
		$biografija = $rows['biografija'];
		$slika = $rows['slika'];
        $pass = $rows['pass'];

		if ($slika == ''){$slika = 'img/profil.png';}

?>
<div class="container min_visina">
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
		      <td>Pozicija u timu:</td>
		      <td><?php echo $pozicija; ?></td>
		    </tr>
		    <tr>
		      <td>Nivo studija:</td>
		      <td><?php echo $nivostud; ?></td>
		    </tr>
		    <tr>
		      <td>Email adresa:</td>
		      <td><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></td>
		    </tr>
		    <tr>
		      <td>Web sajt:</td>
		      <td><a href="http://<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a></td>
		    </tr>
		  </tbody>
		</table> 
		<?php
			if (isset($_SESSION['profil'])) {
				echo '<a class="btn btn-primary" href="izmeni_tim_profil.php">Izmeni profil</a>';
			}
		?>
    </div>
  </div>

<?php echo $biografija; ?>
<br>
<br>

</div>

<?php
}
else
{
	header('Location: index.php');
}
require('footer.php');
?>