<?php

define('ABSPATH', 'alumni');
ob_start();
require('head.php');
require('meni2.php');
require('meni.php');

require('config.php');
require('dbcon.php');

	$query = "SELECT idkorisnika FROM alumni_tim";
	$query_result = $con->query($query);
	$num = 0;
	while(mysqli_fetch_array($query_result)){
		$num++;
	}

	if($num<1){
		header('Location: index.php');
	}

	$osoba = array();

	for ($i=1; $i <= $num; $i++) {

	$query = "SELECT * FROM alumni_tim WHERE idkorisnika = $i";
	$query_result = $con->query($query);
	$rows = mysqli_fetch_array($query_result);

	$ime = $rows['ime'] . " " . $rows['prezime'];
	$pozicija = $rows['pozicija'];
	$slika = $rows['slika'];
    $tim_id = $rows['idkorisnika'];

	if ($slika == ''){$slika = 'img/profil.png';}

	$osoba[$i] = '
	    	<center>
	    	<div class="cont">
		  		<a href="tim_profil.php?id='.$tim_id.'"><img class="zabranjen_pristup kocka" src="'.$slika.'" alt="'.$ime.'" class="image zabranjen_pristup"></a>
		  	</div>
				<a href="tim_profil.php?'.$tim_id.'"><h4 class="ime" id="velicina">'.$ime.'</h4></a>
				<hr>
				<h5>'.$pozicija.'</h5>
		  	</center>';
	}

?>

<div class="container min_visina paddb-64">
	<h1>TFZR Alumni tim</h1>
	<hr>

	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			<h2 class="text-center">Razvojni tim</h2>
			<br>
			<div class="col-sm-4 pocetna_studenti">
				<?php echo $osoba[4]; ?>
			</div>
			<div class="col-sm-4 pocetna_studenti">
				<?php echo $osoba[5]; ?>
			</div>
			<div class="col-sm-4 pocetna_studenti">
				<?php echo $osoba[6]; ?>
			</div>
	  	</div>
	</div>
	<hr>

	<div class="row">
		<h2 class="text-center">Studenti - programeri i web dizajneri (verzija 2017)</h2>
		<div class="col-sm-10 col-sm-offset-1">
			<br>
			<div class="col-sm-4 pocetna_studenti">
				<?php echo $osoba[2]; ?>
			</div>
			<div class="col-sm-4 pocetna_studenti">
				<?php echo $osoba[1]; ?>
			</div>
			<div class="col-sm-4 pocetna_studenti">
				<?php echo $osoba[3]; ?>
			</div>
	  	</div>
	</div>
	<hr>

	<div class="row">
	<h2 class="text-center">Studenti - programer i web dizajner (verzija 2014)</h2>
		<div class="col-sm-4 col-sm-offset-4">
			<br>
		    <div class="col-sm-12 pocetna_studenti">
				<?php echo $osoba[7]; ?>
		    </div>
		  </div>
	  </div>
	</div>
	<hr>



	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<h2 class="text-center">Web administratori fakulteta</h2>
			<br>
	    <div class="col-sm-6 pocetna_studenti">
				<?php echo $osoba[8]; ?>
	    </div>

	    <div class="col-sm-6 pocetna_studenti">
				<?php echo $osoba[9]; ?>
	    </div>

	  </div>
	</div>
	<hr>


	<div class="row">
		<div class="col-sm-12">
			<h2 class="text-center">Alumni koordinatori</h2>
			<br>
			<?php
				$query = "SELECT * FROM alumni_tim WHERE idkorisnika>9";
				$query_result = $con->query($query);

				while($rows = mysqli_fetch_array($query_result)){

					$ime = $rows['ime'] . " " . $rows['prezime'];
					$pozicija = $rows['pozicija'];
					$slika = $rows['slika'];
    				$tim_id = $rows['idkorisnika'];
			?>
			    <div class="col-sm-3 pocetna_studenti">
			    	<center>
			    	<div class="cont">
				  		<a href="tim_profil.php?id=<?php echo $tim_id; ?>"><img class="zabranjen_pristup kocka"> src="<?php if ($slika != ''){echo $slika;} else {echo 'img/profil.png';} ?>" alt="<?php echo $ime; ?>" class="image zabranjen_pristup"></a>
				  	</div>
						<a href="tim_profil.php?<?php echo $tim_id; ?>"><h4 class="ime" id="velicina"><?php echo $ime; ?></h4></a>
						<hr>
						<h5><?php echo $pozicija; ?></h5>
				  	</center>
			    </div>

			<?php
				}
			?>
	 	</div>
	</div>
	<hr>

<style>
	body{overflow-x: hidden;}
</style>
		
	</div>
</div>

<?php
require('footer.php');
?>