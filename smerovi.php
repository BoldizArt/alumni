<?php

if ( !defined('ABSPATH')) {
  die();
}

	if (isset($_POST['smer'])) {

### Treba definisati smerove preko xml fajla i include-ovati ovde ili napraviti poseban table u bazu i tamu upisati podatke.

		if($_POST['smer'] == "DiPTiOM") {
			$grupa = "Odevne tehnologije";
			$smer = "Dizajn i projektovanje tekstila i odeće";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'IT') {
			$grupa = "Informacione tehnologije";
			$smer = "Informacione tehnologije";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'ITM') {
			$grupa = "Informacione tehnologije";
			$smer = "Informacione tehnologije";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'ITSI') {
			$grupa = "Informacione tehnologije";
			$smer = "Softversko inženjerstvo";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'ITuEUiPSM') {
			$grupa = "Informacione tehnologije";
			$smer = "Informacione tehnologije u e upravi i poslovnim sistemima";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'ItI') {
			$grupa = "Informatičko inženjerstvo";
			$smer = "Informatičko inženjerstvo";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'IuO') {
			$grupa = "Informatičko inženjerstvo";
			$smer = "Informatika u obrazovanju";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'IuOM') {
			$grupa = "Informatičko inženjerstvo";
			$smer = "Informatika u obrazovanju";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'IiTuO') {
			$grupa = "Informatičko inženjerstvo";
			$smer = "Informatika i tehnika u obrazovanju";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] =='IiTuOM') {
			$grupa = "Informatičko inženjerstvo";
			$smer = "Informatika i tehnika u obrazovanju";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'IM') {
			$grupa = "Inženjerski menadžment";
			$smer = "Inženjerski menadžment";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'IMM') {
			$grupa = "Inženjerski menadžment";
			$smer = "Inženjerski menadžment";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'IMD') {
			$grupa = "Inženjerski menadžment";
			$smer = "Inženjerski menadžment";
			$nivostud = "Doktorske studije";
		}
		elseif ($_POST['smer'] == 'IZZS') {
			$grupa = "Zaštita životne sredine";
			$smer = "Inženjerstvo zaštite životne sredine";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'IZZSM') {
			$grupa = "Zaštita životne sredine";
			$smer = "Inženjerstvo zaštite životne sredine";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'II') {
			$grupa = "Industrijsko inženjerstvo";
			$smer = "Industrijsko inženjerstvo";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'II') {
			$grupa = "Industrijsko inženjerstvo";
			$smer = "Industrijsko inženjerstvo";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'IIMS') {
			$grupa = "Industrijsko inženjerstvo";
			$smer = "Industrijsko inženjerstvo mašinske struke";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'IIMSM') {
			$grupa = "Industrijsko inženjerstvo";
			$smer = "Industrijsko inženjerstvo mašinske struke";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'IIuENiG') {
			$grupa = "Industrijsko inženjerstvo";
			$smer = "Industrijsko inženjerstvo u eksplotaciji nafte i gasa";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'MI') {
			$grupa = "Mašinsko inženjerstvo";
			$smer = "Mašinsko inženjerstvo";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'MIT') {
			$grupa = "Informacione tehnologije";
			$smer = "Menadžment informacionih tehnologija";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'MPK') {
			$grupa = "Menadžment";
			$smer = "Menadžment poslovnih komunikacija";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'MPKM') {
			$grupa = "Menadžment";
			$smer = "Menadžment poslovnih komunikacija";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'OI') {
			$grupa = "Odevno inženjerstvo";
			$smer = "Odevno inženjerstvo";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'OIM') {
			$grupa = "Odevno inženjerstvo";
			$smer = "Odevno inženjerstvo";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'OT') {
			$grupa = "Odevna tehnologija";
			$smer = "Odevna tehnologija";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'OTM') {
			$grupa = "Odevna tehnologija";
			$smer = "Odevna tehnologija";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'PT') {
			$grupa = "Profesor tehnike";
			$smer = "Profesor tehnike";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'PTM') {
			$grupa = "Profesor tehnike";
			$smer = "Profesor tehnike";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'PTiI') {
			$grupa = "Profesor tehnike";
			$smer = "Profesor tehnike i informatike";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'PTiIM') {
			$grupa = "Profesor tehnike";
			$smer = "Profesor tehnike i informatike";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'PM') {
			$grupa = "Proizvodni menadžment";
			$smer = "Proizvodni menadžment";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'PMM') {
			$grupa = "Proizvodni menadžment";
			$smer = "Proizvodni menadžment";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'PI') {
			$grupa = "Poslovna informatika";
			$smer = "Poslovna informatika";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'PIM') {
			$grupa = "Poslovna informatika";
			$smer = "Poslovna informatika";
			$nivostud = "Master studije";
		}
		elseif ($_POST['smer'] == 'UTS') {
			$grupa = "Upravljanje";
			$smer = "Upravljanje tehničkim sistemima";
			$nivostud = "Osnovne studije";
		}
		elseif ($_POST['smer'] == 'UTSM') {
			$grupa = "Upravljanje";
			$smer = "Upravljanje tehničkim sistemima";
			$nivostud = "Master studije";
		}

	}else
	{
		$greska_smer = "has-error";
		$greska = "da";
		echo $greska_poruka;
	}

?>