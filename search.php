<?php
ob_start();
define('ABSPATH', 'alumni');
require('head.php');
require('meni2.php');
require('meni.php');

if (isset($_POST['search'])) {
	$provera = new proveraUnosa($_POST['search']);
	$reci = $provera->test_input();
	 if(strlen($reci)<3){
	 	$_SESSION['min3']="MIN3";
	 	header('Location: search.php');
    }
}

?>

<div class="container paddtb-32 min_visina">
	<h3>Rezultati pretrage <?php if (isset($reci)) {
		echo " za <i>\"" . $reci . "\"</i>"; } ?></h3>
<?php
	if (isset($_POST['search']) && $_POST['search']!="") {
?>
	<table class="table table-striped table-hover">
	  <thead>
	    <tr>
	      <th></th>
	      <th>Prezime i Ime</th>
	      <th class="mobile-hide">Smer</th>
	      <th>Datum dipl.</th>
	      <th class="mobile-hide">Naziv firme</th>
	      <th class="mobile-hide">Biografija</th>
	    </tr>
	  </thead>
	  <tbody>
<?php
	require('config.php');
	require('dbcon.php');
		
	$words = explode(" ", $_POST['search']);
	  foreach ($words as $search) {
		$provera = new proveraUnosa($search);
		$search = $provera->test_input();
		$search = preg_replace("#[^0-9a-zA-ZČčŠšĆćĐđŽž?!]#i","", $search);	

		$query = "SELECT * FROM korisnik WHERE ime LIKE '%$search%' OR prezime LIKE '%$search%' OR nazivfirme LIKE '%$search%' OR godinadipl LIKE '%$search%' OR smer LIKE '%$search%'";
		$query_result = $con->query($query);
		$num_rows = mysqli_num_rows($query_result);

		if ($num_rows<1) {
			header('Location: search.php');
		}
	
		while ($rows = mysqli_fetch_array($query_result)) {
		$id = $rows['idkorisnika'];
		$ime = $rows['prezime'] . " " . $rows['ime'];
		$smer = $rows['smer'];
		$datum = $rows['godinadipl'];
		$nazivfirme = $rows['nazivfirme'];
		$link = "profil.php?id=$id";
		$foto_link = $rows['fotografija'];
		$status = $rows['status'];
		if ($status == "odobreno") {

?>
	    <tr>
	      <td>
	      	<center>
	      		<a href="<?php echo $link; ?>">
	      			<img class="pretraga_slika zabranjen_pristup" src="<?php echo $foto_link; ?>" alt="<?php echo $ime; ?>">
	      		</a>
	      	</center>
	      </td>
	      <td class="ime">
	      	<?php echo $ime; ?>
	      </td>
	      <td class="mobile-hide">
	      	<?php echo $smer; ?>
	      </td>
	      <td>
	      	<?php echo $datum; ?>
	      </td>
	      <td class="mobile-hide">
	      	<?php echo $nazivfirme; ?>
	      </td>
	      <td>
	      	<a href="<?php echo $link; ?>">Detalji...</a>
	      </td>
	    </tr>
<?php
		}

		}
	  }
	}
	else
	{
		if (isset($_SESSION['min3'])) {
			echo "<i>Minimalni broj cifara za pretragu je 3!</i>";
			unset($_SESSION['min3']);
		}
		else
		{
			echo "<i>Nema rezultata...</i>";
		}
	}
?>
	  </tbody>
	</table>

</div>

<?php
require('footer.php');
?>