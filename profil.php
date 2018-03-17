<?php
define('ABSPATH', 'alumni');
require('head.php');
require('meni2.php');
require('meni.php');

?>
<div class="container min_visina">
<br class="tablet-hide">
<?php

	if (isset($_GET['id'])) {

	require('config.php');
	require('dbcon.php');

		$id = $_GET['id'];
		$query = "SELECT * FROM korisnik WHERE idkorisnika = '$id' AND status='odobreno'";
		$query_result = $con->query($query);
	if (mysqli_num_rows($query_result)>0) {
	
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

<div class="row paddb-32">
    <div class="col-sm-4">
    <h3 class="tablet-show ime"><?php echo $ime ?></h3>
		<br>
    <center>
    	<img src="<?php echo $slika; ?>"  alt="<?php echo $ime;?>" class="profilna_slika zabranjen_pristup">
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
		    

    <?php
		$greska_status = "";
        
        if (isset($_SESSION['status']) && $_SESSION['status']=="admin")
        {
		if ($status!="admin" || $status="odbaceno") 
        {
	?>
		    <tr>
              <form action="<?php echo 'profil_status.php?id='.$id; ?>" method="POST">
		      <td>
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
	   }
	?>
		    
		    
		  </tbody>
		</table> 
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
<?php
	}
	else
	{
		echo "<i><h3>Ovaj student ne postoji!</h3></i>";
	}
?>
</div>
<?php
}
require('footer.php');
?>