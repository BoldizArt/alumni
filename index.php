<?php

/*
	Fajl kreirao: Santo Boldižar
	Godina: 2017
	Kontakt: boldizar.santo@gmail.com
*/
	
define('ABSPATH', 'alumni');
$active = "alumni";
require('head.php');
require('meni2.php');
require('meni.php');

?>

<div class="fluid-container naslovna">
	<!--<img src="book.jpg" alt="" class="naslovna">-->
	<div class="container paddb-32 margt-64 cw">
		<br>
		<br>
		<center><br><br><br><br>
			<img src="img/logo.png">
			<h1 class="dupli">ALUMNI</h1>
			<h4>Tehničkog Fakulteta "Mihajlo Pupin" u Zrenjaninu</h4>
		</center>
	</div>
</div>
<br>
<br>


<div class="container-fluid">
	<div class="container paddb-64">
	<center>
	<h4>GDE RADE DIPLOMIRANI STUDENTI TEHNIČKOG FAKULTETA "MIHAJLO PUPIN" U ZRENJANINU?</h4>
 
 	<p>Neki od naših diplomiranih studenata prezentovali su podatke o svojim radnim biografijama, opisali svoja iskustva sa studija i uputili poruke budućim kolegama...</p>
	<hr>
	</center>
		<div class="row paddtb-32">

<!-- Profilne slike i opis -->
<?php

require('config.php');
require('dbcon.php');
$query = "SELECT * FROM korisnik WHERE status='odobreno' ORDER BY rand() LIMIT 8";
$query_result = $con->query($query);

while($rows = mysqli_fetch_array($query_result)){
	$status = $rows['status'];

	$ime =$rows['ime']  . " " . $rows['prezime'];
	$grupa = $rows['grupa'];
	$id = $rows['idkorisnika'];
	$link = "profil.php?id=$id";
	$foto_link = $rows['fotografija'];
	$tekstobjave = $rows['biografija'];
	$bio = substr($tekstobjave,0,120);
	$biografija = $bio . "...";
	$prvoslovo = substr($rows['prezime'],0,1);

	if($grupa == "Odevne tehnologije" || $grupa == "Odevno inženjerstvo" || $grupa == "Odevna tehnologija"){
		$color = "red";
	}
	elseif ($grupa == "Informacione tehnologije" || $grupa == "Informatičko inženjerstvo" || $grupa == "Poslovna informatika") {
		$color = "#2e79f2";
	}
	elseif ($grupa == "Inženjerski menadžment" || $grupa == "Menadžment" || $grupa == "Upravljanje" || $grupa == "Proizvodni menadžment") {
		$color = "#ff8042";
	}
	elseif ($grupa == "Zaštita životne sredine") {
		$color = "#26bc12";
	}
	elseif ($grupa == "Industrijsko inženjerstvo" || $grupa == "Mašinsko inženjerstvo" || $grupa == "Profesor tehnike" || $grupa == "Informatika i tehnika u obrazovanju"){
		$color = "#131a21";
	}

	if ($grupa=="Informatika i tehnika u obrazovanju") {
		$grupa="Informatika i tehnika";
	}

	if (strlen($rows['prezime'] . " " . $rows['ime'])>17) {
		$ime = $rows['ime'] . " " . $prvoslovo . "."; 
	}
?>


		    <div class="col-sm-3 pocetna_studenti">
		    	<center>
		    	<div class="cont">
			  			<a href="<?php echo $link; ?>"><img src="<?php echo $foto_link; ?>" alt="<?php echo $ime;?>" class="image zabranjen_pristup"></a>
			  		<div class="overlay">
			    		<div class="text">
				    		<p><?php echo $biografija; ?></p>
							<a class="detaljnije" href="<?php echo $link; ?>">Detaljnije...</a>
			    		</div>
			  		</div>
			  	</div>
  				<a href="<?php echo $link; ?>"><h4 class="ime" id="velicina"><?php echo $ime; ?></h4></a>
  				<hr style="border-color: <?php echo $color; ?>;">
					<h5><?php echo $grupa; ?></h5>
			  	</center>
		    </div>
<?php
}
$query = mysqli_query($con, "SELECT idkorisnika FROM korisnik WHERE status='odobreno'");
$sviPrijavljeni = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT idkorisnika FROM korisnik WHERE nivostud='Osnovne akademske studije' and status='odobreno'");
$diplomiraniInzenjeri = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT idkorisnika FROM korisnik WHERE nivostud='Master studije' and status='odobreno'");
$masterInzenjeri = mysqli_num_rows($query);

$query = mysqli_query($con, "SELECT idkorisnika FROM korisnik WHERE nivostud='Doktorske studije' and status='odobreno'");
$doktorNauke=  mysqli_num_rows($query);

?>

<!-- Kraj opisa -->
		  
		</div>
	</div>
</div>

<div class="fluid-container statistika">
	<div class="container">
		<div class="row paddtb-32">
		<center>
			<div class="col-sm-3">
			<i class="fa fa-graduation-cap cw font-36" aria-hidden="true"></i>
				<h2><?php echo $sviPrijavljeni; ?></h2>
				<p>Prijahljenih studenata</p>
			</div>
			<div class="col-sm-3">
			<i class="fa fa-users cw font-36" aria-hidden="true"></i>
				<h2><?php echo $diplomiraniInzenjeri; ?></h2>
				<p>Diplomiranih inženjera</p>
			</div>
			<div class="col-sm-3">
			<i class="fa fa-user cw font-36" aria-hidden="true"></i>
				<h2><?php echo $masterInzenjeri; ?></h2>
				<p>Master inženjera</p>
			</div>
			<div class="col-sm-3">
			<i class="fa fa-user-circle-o cw font-36" aria-hidden="true"></i>
				<h2><?php echo $doktorNauke; ?></h2>
				<p>Doktora nauke</p>
			</div>
		</center>
		</div>
	</div>
</div>
<br>
<br>


<!-- Slajder -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indikatori -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

<?php
$query = "SELECT * FROM korisnik WHERE status='odobreno' AND poruka!='' ORDER BY rand() LIMIT 6";
$query_result = $con->query($query);
	  $sl = 0;
while($rows = mysqli_fetch_array($query_result)){

  $status = $rows['status'];
  $poruka = $rows['poruka'];
  $ime =$rows['ime']  . " " . $rows['prezime'];
  $id = $rows['idkorisnika'];
  $link = "profil.php?id=$id";
  $foto_link = $rows['fotografija'];
  $poruka = $rows['poruka'];
  $sl++;
?>
      <div class="item <?php if ($sl==1) {
      	echo "active";
      } ?> row">
        <div class="col-sm-1"></div>
      <div class="col-sm-3">
        <center>
          <a href="<?php echo $link; ?>">
            <img src="<?php echo $foto_link; ?>" alt="<?php echo $ime;?>" class="image zabranjen_pristup">
          </a>
        </center>
      </div>
      <div class="col-sm-7 pocetna_tekst">
        <blockquote>
          <p class="citat">
            <i class="citat">
              <i class="fa fa-quote-left" aria-hidden="true"></i>
                <?php echo $poruka; ?>
              <i class="fa fa-quote-right" aria-hidden="true"></i>
            </i>
          </p>
          <footer>
            <a class="ime" href="<?php echo $link; ?>"><?php echo $ime; ?>
            </a>
          </footer>
        </blockquote>
      </div>
      </div>
<?php
}
?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<?php
require('footer.php');
?>