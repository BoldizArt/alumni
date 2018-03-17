<?php
ob_start();
define('ABSPATH', 'alumni');
require('head.php');
require('meni2.php');
require('meni.php');


    if (!isset($_SESSION['status'])){
        header('Location: index.php');
    }
	if (isset($_GET['id'])) {

	require('config.php');
	require('dbcon.php');

		$id = $_GET['id'];
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

?>
<div class="container min_visina">
	<br class="tablet-hide">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['izaberi']))
{
### PORUKE - PRIHVATANJE_KORISNIKA_GRESKA
	if (isset($_POST['status'])) {
		$provera = new proveraUnosa($_POST['status']);
		$status = $provera->test_input();
		$id = $_GET['id'];
		if ($status=='0') {
			$greska_status = "has-error";
			echo '<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Morate izabrati jean od ponuđenih odgovora kako bi odobrili ili odbacili korisnika!</strong>
			</div>';
		}
		else
		{
		$query = mysqli_query($con, "UPDATE korisnik SET status='$status' WHERE idkorisnika='$id'");

	$subject = "Uspešno ste se registrovali!";
    $message = '
      <div>
        <strong>Poštovani/a ' . $ime . ', uspešno ste se registrovali, čestitamo!<br/>
        <strong>Kliknite <a href="'.$url.'"> ovde</a> da pogledate vaš profil.</strong><br/>
      </div>
    ';
    $headers = 'MINE-Version: 1.0' . "/r/n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "/r/n";

    $headers .= 'From: "Admin" <admin.alumni@tfzr.rs>' . "/r/n";

		mail($email, $subject, $message, $headers);
		header('refresh:0; url=prijavljeni.php');
		}
		
	}else
	{
		
	}
}
?>


<div class="row paddb-32">
    <div class="col-sm-4">
    <h3 class="tablet-show"><?php echo $prezime . " " . $ime ?></h3>
		<br>
    <center>
    	<img src="<?php echo $slika; ?>" alt="" style="width: 80%; border-radius: 500px;">
    </center>
    </div>
    <br>
    <div class="col-sm-8">
	<h3 class="tablet-hide"><?php echo $prezime . " " . $ime ?></h3>
		<i style="color: grey;">Čeka se na odobrenje...</i>
		<br>
		<br>
		<table class="table table-striped table-hover">
		  <tbody>
		    <tr>
		      <td>Smer:</td>
		      <td><?php echo $smer; ?></td>
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

	<?php
		$greska_status = "";
		if ($status!="admin" && $status!="odobreno" && $status!="odbaceno") {
	?>
		    <tr>
		      <td>
		      <form action="<?php echo 'profil_status.php?id='.$id; ?>" method="POST">
			      <select name="status" id="">
			      	<option value="0">Izaberi...</option>
			      	<option value="odobreno">Odobreno</option>
					<option value="odbaceno">Odbačeno</option>
			      </select>
		      </td>
		      <td><input type="submit" name="izaberi" class="btn" value="Sačuvaj"></td>
		      </form>
		    </tr>
	<?php
	}
	?>

		  </tbody>
		</table> 
    </div>
  </div>

<?php echo $biografija; ?>
<br>
<br>
<div style="width:80%;" class="paddb-32">
	<blockquote>
	  <p><?php echo $poruka; ?></p>
	  <small><cite title="<?php echo $prezime . " " . $ime; ?>"><?php echo $prezime . " " . $ime; ?></cite></small>
	</blockquote>
</div>

</div>

<?php
}
require('footer.php');
?>