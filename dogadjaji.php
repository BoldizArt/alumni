<?php
define('ABSPATH', 'alumni');
$active = "dogadjaji";
require('head.php');
require('meni2.php');
require('meni.php');
require('config.php');
require('dbcon.php');

$query = "SELECT * FROM objava ORDER BY datumobjave DESC";
$query_result = $con->query($query);
?>
<div class="container min_visina">

<?php
if (mysqli_num_rows($query_result)>0) {

    while ($rows = mysqli_fetch_array($query_result)) {
        $naslov = $rows['naslovobjave'];
        $tekst = $rows['tekstobjave'];
        $slika ="img/" . $rows['slikaobjave'];
        if ($rows['slikaobjave'] == "") {
            $slika = "img/dogadjaj.jpg";
        }
        $i = $rows['idobjava'];
        $idadmina = $rows['adminid'];
        $i = $rows['idobjava'];

        $query2 = "SELECT * FROM korisnik WHERE idkorisnika='$idadmina'";
        $query_result2 = $con->query($query2);
        $rows2 = mysqli_fetch_array($query_result2);
        $ime = $rows2['ime'] . " " . $prezime = $rows2['prezime'];
     
        if ($i%2 >0) {
    ?>

    <br class="tablet-hide">
    <div class="row paddb-32">
    	<div class="col-sm-9">
    	<h3 class=""><?php echo $naslov ?></h3>
    		<hr>
    		<blockquote  class="blockquote-reverse">
    	  <p><?php echo $tekst . ".";?></p>
    	  <small>Objavio/la: <cite title="Source Title"><?php echo $ime ?></cite></small>
    	</blockquote>
    		
        </div>
        <br>
        <div class="col-sm-3">
    		<br>
        <center class="mar_to25">
        	<img src="<?php echo $slika; ?>" alt="Alumni vesti" class="profilna_slika zabranjen_pristup">
        </center>
        </div>
      </div>

    <?php

        }
        else
        {

    ?>


    <br class="tablet-hide">
    <div class="row paddb-32">
        <div class="col-sm-3">
        <h3 class="tablet-show"><?php echo $naslov ?></h3>
    		<br>
        <center class="mar_to25">
        	<img src="<?php echo $slika; ?>" alt="Alumni vesti" class="profilna_slika">
        </center>
        </div>
        <br>
        <div class="col-sm-9">
    	<h3 class="tablet-hide"><?php echo $naslov ?></h3>
    		<hr>
    		<blockquote>
    	  <p><?php echo $tekst . ".";?></p>
    	  <small>Objavio/la: <cite title="Source Title"><?php echo $ime ?></cite></small>
    	</blockquote>
    		
        </div>
      </div>

    <?php
        }
    }
}
else
{
    echo "<h3>Nije pronađena nijedna objava!</h3>";
}
?>

</div>
<?php
require('footer.php');
?>