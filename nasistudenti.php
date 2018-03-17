<?php
define('ABSPATH', 'alumni');
$active = "nasistudenti";
require('head.php');
require('meni2.php');
require('meni.php');
?>


<div class="container paddtb-32 min_visina">
	<h2 style="color: black">NAŠI STUDENTI</h2>
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

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	else 
	{
		$page = 0;
	}
	
	if ($page=='' || $page=='1' ) {
		$page1 = 0;
	}
	else
	{
		$page1 = ($page*10)-10;
	}

	$query = "SELECT * FROM korisnik WHERE status='odobreno' ORDER BY ime limit $page1,10";
	$query_result = $con->query($query);
	
	while ($rows = mysqli_fetch_array($query_result)) {
		$id = $rows['idkorisnika'];
		$ime = $rows['ime'] . " " . $rows['prezime'];
		$smer = $rows['smer'];
		$datum = $rows['godinadipl'];
		$nazivfirme = $rows['nazivfirme'];
		$link = "profil.php?id=$id";
		$foto_link = $rows['fotografija'];

?>
	    <tr>
	      <td><center><a href="<?php echo $link; ?>"><img src="<?php echo $foto_link; ?>" class="nasi_studenti zabranjen_pristup" alt="<?php echo $ime;?>"></a></center></td>
	      <td class="ime"><?php echo $ime; ?></td>
	      <td class="mobile-hide"><?php echo $smer; ?></td>
	      <td><?php echo $datum; ?></td>
	      <td class="mobile-hide"><?php echo $nazivfirme; ?></td>
	      <td><a href="<?php echo $link; ?>">Detalji...</a></td>
	    </tr>
<?php
}

$query = mysqli_query($con, "SELECT idkorisnika FROM korisnik WHERE status='odobreno' ORDER BY ime");
	$brojredova = mysqli_num_rows($query);
	$a = $brojredova/10;
	$a = ceil($a);	
	
?>
	  </tbody>
	</table>

	<center>
	<ul class="pagination">

<?php 

	if ($page>1) { 
		$nazad = $page-1;
		echo "<li><a href=\"nasistudenti.php?page=$nazad\">&laquo;</a></li>";
	}

	for ($b=1; $b <= $a; $b++) {
?>

	<li class="<?php if ($b==$page) { echo "active";} ?>"><a href="nasistudenti.php?page=<?php echo $b;?>"><?php echo $b; ?></a></li>

<?php
	}

	if ($page<$a) { 
		$napred = $page+1;
		echo "<li><a href=\"nasistudenti.php?page=$napred\">&raquo;</a></li>";
	}
?>

		</ul>
	</center>
</div>

<?php
require('footer.php');
?>