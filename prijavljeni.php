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

<div class="container paddtb-32 min_visina">
	<h2 style="color: black">ČEKA SE NA ODOBRENJE...</h2>
	<table class="table table-striped table-hover">
	  <thead>
	    <tr>
	      <th class="mobile-hide"></th>
	      <th>Prezime i Ime</th>
	      <th class="mobile-hide">Smer</th>
	      <th>Biografija</th>
	      <th>Status</th>
	      <th></th>
	    </tr>
	  </thead>
	  <tbody>
<?php
	$greska_status = "";
	require('config.php');
	require('dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['izaberi']))
{
	if (isset($_POST['status'])) {
### PORUKE - PRIHVATANJE_KORISNIKA_GRESKA
		$provera = new proveraUnosa($_POST['status']);
		$status = $provera->test_input();
		$id = $_GET['id'];
		if ($status=='0') {
			$greska_status = "has-error";
			echo '<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Morate izabrati jedan od ponuđenih odgovora kako bi odobrili ili odbacili korisnika!</strong>
			</div>';
		}
		else
		{
		$query = mysqli_query($con, "UPDATE korisnik SET status='$status' WHERE idkorisnika='$id'");

	$subject = "Uspešno ste se registrovali!";
    $message = '
      <div>
        <strong class="ime">Poštovani/a ' . $ime . ', uspešno ste se registrovali, čestitamo!<br/>
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

	$query = "SELECT * FROM korisnik WHERE status='neodredjeno' ORDER BY ime limit $page1,10";
	$query_result = $con->query($query);

	while ($rows = mysqli_fetch_array($query_result)) {
		$id = $rows['idkorisnika'];
		$ime = $rows['prezime'] . " " . $rows['ime'];
		$smer = $rows['smer'];
		$email = $rows['email'];
		$datum = $rows['godinadipl'];
		$radnomesto = $rows['radnomesto'];
		$link = "profil_status.php?id=$id";
		$foto_link = $rows['fotografija'];
		$status = $rows['status'];
		$subject = "subject";
		$message = "Message";
		$url = "profil.php?id=" . $id;
	if ($status!="admin" && $status!="odobreno" && $status!="odbaceno") {
?>
	    <tr>
	      <td class="mobile-hide"><center><a href="<?php echo $link; ?>"><img style="width:50px; border-radius: 50px" src="<?php echo $foto_link; ?>" alt="<?php echo $ime;?>"></a></center></td>
	      <td class="ime"><?php echo $ime; ?></td>
	      <td class="mobile-hide"><?php echo $smer; ?></td>
	      <td><a href="<?php echo $link; ?>">Detalji...</a></td>
			<form action="<?php echo 'prijavljeni.php?id='.$id; ?>" method="POST">
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
$query = mysqli_query($con, "SELECT idkorisnika FROM korisnik WHERE status='neodredjeno' ORDER BY ime");
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
		echo "<li><a href=\"prijavljeni.php?page=$nazad\">&laquo;</a></li>";
	}

	for ($b=1; $b <= $a; $b++) {
?>

	<li class="<?php if ($b==$page) { echo "active";} ?>"><a href="prijavljeni.php?page=<?php echo $b;?>"><?php echo $b; ?></a></li>

<?php
	}

	if ($page<$a) { 
		$napred = $page+1;
		echo "<li><a href=\"prijavljeni.php?page=$napred\">&raquo;</a></li>";
	}
?>

		</ul>
	</center>

</div>

<?php
require('footer.php');
?>