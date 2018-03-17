<?php
if ( !defined('ABSPATH')) {
  die();
}
  require('config.php');
  require('dbcon.php');
  $query = mysqli_query($con, "SELECT idkorisnika FROM korisnik WHERE status='neodredjeno'");
  $brojprijavljenih = mysqli_num_rows($query);
?>
    <div class="navbar-header">
      <a href="index.php" class="pocetna desktop-hide"><span>ALUMNI</span></a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
    		<li style="<?php echo $hide2; ?>" class="desktop-hide"><a href="registracija.php"><span class="<?php if (isset($active) && $active=='registracija'){echo 'bbactive';} ?>">REGISTRACIJA</span></a></li>
    		<li style="<?php echo $hide2; ?>" class="desktop-hide"><a href="#" data-toggle="modal" data-target="#myModal"><span class="<?php if (isset($ctive) && $active=='prijava'){echo 'bbactive';} ?>">PRIJAVA</span></a></li>
      	<li><a href="index.php"><span class="<?php if (isset($active) && $active=='alumni'){echo 'bbactive';} ?>"><span>ALUMNI</span></u></a></li>
        <li><a href="nasistudenti.php?page=1"><span class="<?php if (isset($active) && $active=='nasistudenti'){echo 'bbactive';} ?>">NAŠI STUDENTI</span></a></li>
        <li><a href="dogadjaji.php"><span class="<?php if (isset($active) && $active=='dogadjaji'){echo 'bbactive';} ?>">DOGAĐAJI</span></a></li>
        <li><a href="kontakt.php"><span class="<?php if (isset($active) && $active=='kontakt'){echo 'bbactive';} ?>">KONTAKT</span></a></li>
        <li><a href="#cyr"><span>ĆIR</span></a></li>
        <li><a href="#lat"><span>LAT</span></a></li>
      </ul>
      
      <ul class="<?php echo $hide;?> nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "Dobrodošli, <b>" . $korisnik . "</b>";?><i class="<?php echo $hide3; ?>"> (Admin)</i><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="mojprofil.php"><i class="fa fa-user" aria-hidden="true"> </i> MOJ PROFIL</a></li>
            <li role="separator" class="divider"></li>
            <li class="<?php echo $hide3; ?>"><a href="prijavljeni.php?page=1"><i class="fa fa-group" aria-hidden="true"> </i> PRIJAVLJENI <span class="badge"><?php if ($brojprijavljenih>0) {
              echo $brojprijavljenih; } ?></span></a></li>
            <li class="<?php echo $hide3; ?>"><a href="alumni_tim.php"><i class="fa fa-group" aria-hidden="true"> </i> ALUMNI TIM </a></li>
            <li role="separator" class="divider <?php echo $hide3; ?>"></li>
            <li class="<?php echo $hide3; ?>"><a href="dodajdogadjaj.php"><i class="fa fa-pencil" aria-hidden="true"> </i> DODAJ DOGAĐAJ</a></li>
            <li role="separator" class="divider <?php echo $hide3; ?>"></li>
            <li><a href="odjava.php"><i class="fa fa-sign-in" aria-hidden="true"> </i> ODJAVA</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>