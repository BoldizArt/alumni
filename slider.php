<?php
if ( !defined('ABSPATH')) {
  die();
}
?>

<div class="galerija" style="width: 80%; margin: 32px auto; position: relative">

<?php
require('config.php');
require('dbcon.php');

$query = "SELECT * FROM korisnik WHERE status='odobreno' AND poruka!='' ORDER BY rand() LIMIT 6";
$query_result = $con->query($query);

while($rows = mysqli_fetch_array($query_result)){

  $status = $rows['status'];
  $poruka = $rows['poruka'];
  $ime =$rows['ime']  . " " . $rows['prezime'];
  $id = $rows['idkorisnika'];
  $link = "profil.php?id=$id";
  $foto_link = $rows['fotografija'];
  $poruka = $rows['poruka'];
 
?>
  <div class="slajder">
    <div class="row">
      <div class="col-sm-1"></div>
        <div class="col-sm-3">
          <center>
            <a href="<?php echo $link; ?>"><img src="<?php echo $foto_link; ?>" alt="Avatar" class="image" style="border-radius: 500px; width: 75%;"></a>
          </center>
        </div>
      <div class="col-sm-7">
        <blockquote>
          <p>
            <i class="citat">
              <i class="fa fa-quote-left" aria-hidden="true"></i> 
                <?php echo $poruka; ?> 
              <i class="fa fa-quote-right" aria-hidden="true"></i>
            </i>
          </p>
            <footer>
              <a href="<?php echo $link; ?>"><?php echo $ime; ?></a>
            </footer>
        </blockquote>
      </div>
    </div>
  </div>

<?php
}
?>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span>
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
  <span class="dot" onclick="currentSlide(6)"></span> 
</div>
<br>
<br>

<script>var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slajder");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}</script>
