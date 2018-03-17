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
	<h2 style="color: black">TFZR ALUMNI TIM</h2>
<?php

	require('config.php');
	require('dbcon.php');

if (isset($_GET['delid']) && ($_SESSION['status'] == 'admin')) {
	$delid = $_GET['delid'];
	if ($delid >9) {
		$query = "DELETE FROM alumni_tim WHERE idkorisnika = $delid";
		$query_result = $con->query($query);
		echo '<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Osoba je izbrisana!</strong>
		</div>';
	} else {
		echo '<div class="alert alert-dismissible alert-danger">
  			<button type="button" class="close" data-dismiss="alert">&times;</button>
  			<strong>Ova osoba ne sme da bude izbrisana!</strong>
			</div>';
	}
}

if (isset($_POST['sacuvaj']) && ($_SESSION['status'] == 'admin')) {
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$email = $_POST['email'];
		$pozicija = $_POST['pozicija'];
		$biografija = $_POST['biografija'];
		$slika = $_POST['slika'];
		$nivostud = $_POST['nivostud'];
		$website = $_POST['website'];

	$query = "INSERT INTO alumni_tim (ime, prezime, email, pozicija, biografija, slika, nivostud, website) VALUES ('".$ime."', '".$prezime."', '".$email."', '".$pozicija."', '".$biografija."', '".$slika."', '".$nivostud."', '".$website."')";
	$query_result = $con->query($query);
	echo '<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Nova osoba je dodata!</strong>
		</div>';
}

if (isset($_POST['azuriraj']) && ($_SESSION['status'] == 'admin') && isset($_GET['azid'])) {
	$azid = $_GET['azid'];
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$email = $_POST['email'];
	$pozicija = $_POST['pozicija'];
	$biografija = $_POST['biografija'];
	$slika = $_POST['slika'];
	$nivostud = $_POST['nivostud'];
	$website = $_POST['website'];

	$query = "UPDATE alumni_tim SET ime='".$ime."', prezime='".$prezime."', email='".$email."', pozicija='".$pozicija."', biografija='".$biografija."', slika='".$slika."', nivostud='".$nivostud."', website='".$website."' WHERE idkorisnika = $azid";
	$query_result = $con->query($query);
	echo '<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Osoba je ažurirana!</strong>
		</div>';
}

?>
	<table class="table table-striped table-hover">
	  <tbody>
<?php
	$greska_status = "";

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
	}
}

	$query = "SELECT * FROM alumni_tim";
	$query_result = $con->query($query);

	while ($rows = mysqli_fetch_array($query_result)) {
		$id = $rows['idkorisnika'];
		$ime = $rows['ime'];
		$prezime = $rows['prezime'];
		$email = $rows['email'];
		$pozicija = $rows['pozicija'];
		$biografija = $rows['biografija'];
		$slika = $rows['slika'];
		$nivostud = $rows['nivostud'];
		$website = $rows['website'];

?>
	<form action="alumni_tim.php?azid=<?php echo $id;?>" method="POST">
	    <tr>
	      <td></td>
	      <td><span class="ime"><?php echo $ime . ' ' . $prezime; ?></span></td>
	    </tr>
	    <tr>
	      <td>Br.</td>
	      <td>
	      	<input type="text" placeholder="<?php echo $id; ?> - NE SME DA SE MENJA!" name="userid"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Ime</td>
	      <td>
	      	<input type="text" value="<?php echo $ime; ?>" name="ime"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Prezime</td>
	      <td>
	      	<input type="text" value="<?php echo $prezime; ?>" name="prezime"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Email</td>
	      <td>
	      	<input type="email" value="<?php echo $email; ?>" name="email"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Pozicija</td>
	      <td>
	      	<input type="text" value="<?php echo $pozicija; ?>" name="pozicija"/>
	      </td>
		</tr>
	    <tr>
	      <td>Biografija</td>
	      <td>
	      	<input type="text" value="<?php echo $biografija; ?>" name="biografija"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Link do slike</td>
	      <td>
	      	<input type="text" value="<?php echo $slika; ?>" name="slika"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Nivo sdudije</td>
	      <td>
	      	<input type="text" value="<?php echo $nivostud; ?>" name="nivostud"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Web sajt</td>
	      <td>
	      	<input type="text" value="<?php echo $website; ?>" name="website"/>
	      </td>
	    </tr>
	    <tr>
	      <td></td>
	      <td>
	      	<input type="submit" name="azuriraj" class="btn" value="Sačuvaj">
	      </td>
	    </tr>
	    <tr>
	      <td></td>
			<td>
				<a onclick="deleteUser(<?php echo $id; ?>)" href="#" class="obrisi">Obriši</a>
			</td>
	    </tr>
	</form>

<?php
	}
?>
	</tbody>
	</table>
</div>
<hr>
<div class="container paddtb-32 min_visina">
	<table class="table table-striped table-hover">
	  <tbody>
	  	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
	    <tr>
	      <td></td>
	      <td><span class="dodaj-novog">Dodaj novog koordinatora</span></td>
	    </tr>
	    <tr>
	      <td>Ime</td>
	      <td>
	      	<input type="text" placeholder="Ime" name="ime"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Prezime</td>
	      <td>
	      	<input type="text" placeholder="Prezime" name="prezime"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Email</td>
	      <td>
	      	<input type="email" placeholder="Email adresa" name="email"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Pozicija</td>
	      <td>
	      	<input type="text" placeholder="Pozicija u timu" name="pozicija"/>
	      </td>
		</tr>
	    <tr>
	      <td>Biografija</td>
	      <td>
	      	<input type="text" placeholder="Biografija" name="biografija"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Link do slike</td>
	      <td>
	      	<input type="text" placeholder="Link do slike" name="slika"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Nivo sdudije</td>
	      <td>
	      	<input type="text" placeholder="Nivo sdudije" name="nivostud"/>
	      </td>
	    </tr>
	    <tr>
	      <td>Web sajt</td>
	      <td>
	      	<input type="text" placeholder="Web sajt (bez http://)" name="website"/>
	      </td>
	    </tr>
	    <tr>
	      <td></td>
	      <td>
	      	<input type="submit" name="sacuvaj" class="btn" value="Sačuvaj">
	      </td>
	    </tr>
	    </form>
	</tbody>
	</table>

</div>

<style>
	table input{width: 100%; padding: 4px 16px;}
	span.dodaj-novog,span.ime{font-size: 28px;}
	input[type="submit"]:hover{
		color: #fff;
		background: #4d4d4d;
	}
	a.obrisi{
		padding: 6px 12px;
		width: 100%;
		max-width: 100%;
		border: 1px solid #ff7c7c;
		color: #ff7c7c;
		text-decoration: none;
		border-radius: 5px;
		margin: 1px;
		display: block;
		position: relative;
		text-align: center;
	}
	a.obrisi:hover{
		background-color: #FF0000;
		color: #fff;
	}
</style>

<script type="text/javascript">
	function deleteUser($delid) {
    if (confirm("Da li ste sigurni da želite da izbrišete ovu osobu?")) {
        window.location.href = "alumni_tim.php?delid="+$delid;
    }
    return false;
}
</script>

<?php
require('footer.php');
?>