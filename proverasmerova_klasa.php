<?php

if ( !defined('ABSPATH')) {
  die();
}

	/**
	* Klasa koja razvrstava smerove.
	*/
	class proveraSmerova {

		public $smerovi;
		public $grupa;
		public $smer;
		public $nivostud;
		
		function __construct($smerovi)
		{
			$this->smerovi = $smerovi;
		}

		public function test_input() {

			if($this->smerovi == "DiPTiOM") {
				$this->grupa = "Odevne tehnologije";
				$this->smer = "Dizajn i projektovanje tekstila i odeće";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'IT') {
				$this->grupa = "Informacione tehnologije";
				$this->smer = "Informacione tehnologije";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'ITM') {
				$this->grupa = "Informacione tehnologije";
				$this->smer = "Informacione tehnologije";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'ITSI') {
				$this->grupa = "Informacione tehnologije";
				$this->smer = "Softversko inženjerstvo";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'ITuEUiPSM') {
				$this->grupa = "Informacione tehnologije";
				$this->smer = "Informacione tehnologije u e upravi i poslovnim sistemima";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'ItI') {
				$this->grupa = "Informatičko inženjerstvo";
				$this->smer = "Informatičko inženjerstvo";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'IuO') {
				$this->grupa = "Informatičko inženjerstvo";
				$this->smer = "Informatika u obrazovanju";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'IuOM') {
				$this->grupa = "Informatičko inženjerstvo";
				$this->smer = "Informatika u obrazovanju";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'IiTuO') {
				$this->grupa = "Informatičko inženjerstvo";
				$this->smer = "Informatika i tehnika u obrazovanju";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi =='IiTuOM') {
				$this->grupa = "Informatičko inženjerstvo";
				$this->smer = "Informatika i tehnika u obrazovanju";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'IM') {
				$this->grupa = "Inženjerski menadžment";
				$this->smer = "Inženjerski menadžment";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'IMM') {
				$this->grupa = "Inženjerski menadžment";
				$this->smer = "Inženjerski menadžment";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'IMD') {
				$this->grupa = "Inženjerski menadžment";
				$this->smer = "Inženjerski menadžment";
				$this->nivostud = "Doktorske studije";
			}
			elseif ($this->smerovi == 'IZZS') {
				$this->grupa = "Zaštita životne sredine";
				$this->smer = "Inženjerstvo zaštite životne sredine";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'IZZSM') {
				$this->grupa = "Zaštita životne sredine";
				$this->smer = "Inženjerstvo zaštite životne sredine";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'II') {
				$this->grupa = "Industrijsko inženjerstvo";
				$this->smer = "Industrijsko inženjerstvo";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'II') {
				$this->grupa = "Industrijsko inženjerstvo";
				$this->smer = "Industrijsko inženjerstvo";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'IIMS') {
				$this->grupa = "Industrijsko inženjerstvo";
				$this->smer = "Industrijsko inženjerstvo mašinske struke";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'IIMSM') {
				$this->grupa = "Industrijsko inženjerstvo";
				$this->smer = "Industrijsko inženjerstvo mašinske struke";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'IIuENiG') {
				$this->grupa = "Industrijsko inženjerstvo";
				$this->smer = "Industrijsko inženjerstvo u eksplotaciji nafte i gasa";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'MI') {
				$this->grupa = "Mašinsko inženjerstvo";
				$this->smer = "Mašinsko inženjerstvo";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'MIT') {
				$this->grupa = "Informacione tehnologije";
				$this->smer = "Menadžment informacionih tehnologija";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'MPK') {
				$this->grupa = "Menadžment";
				$this->smer = "Menadžment poslovnih komunikacija";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'MPKM') {
				$this->grupa = "Menadžment";
				$this->smer = "Menadžment poslovnih komunikacija";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'OI') {
				$this->grupa = "Odevno inženjerstvo";
				$this->smer = "Odevno inženjerstvo";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'OIM') {
				$this->grupa = "Odevno inženjerstvo";
				$this->smer = "Odevno inženjerstvo";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'OT') {
				$this->grupa = "Odevna tehnologija";
				$this->smer = "Odevna tehnologija";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'OTM') {
				$this->grupa = "Odevna tehnologija";
				$this->smer = "Odevna tehnologija";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'PT') {
				$this->grupa = "Profesor tehnike";
				$this->smer = "Profesor tehnike";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'PTM') {
				$this->grupa = "Profesor tehnike";
				$this->smer = "Profesor tehnike";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'PTiI') {
				$this->grupa = "Profesor tehnike";
				$this->smer = "Profesor tehnike i informatike";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'PTiIM') {
				$this->grupa = "Profesor tehnike";
				$this->smer = "Profesor tehnike i informatike";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'PM') {
				$this->grupa = "Proizvodni menadžment";
				$this->smer = "Proizvodni menadžment";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'PMM') {
				$this->grupa = "Proizvodni menadžment";
				$this->smer = "Proizvodni menadžment";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'PI') {
				$this->grupa = "Poslovna informatika";
				$this->smer = "Poslovna informatika";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'PIM') {
				$this->grupa = "Poslovna informatika";
				$this->smer = "Poslovna informatika";
				$this->nivostud = "Master studije";
			}
			elseif ($this->smerovi == 'UTS') {
				$this->grupa = "Upravljanje";
				$this->smer = "Upravljanje tehničkim sistemima";
				$this->nivostud = "Osnovne akademske studije";
			}
			elseif ($this->smerovi == 'UTSM') {
				$this->grupa = "Upravljanje";
				$this->smer = "Upravljanje tehničkim sistemima";
				$this->nivostud = "Master studije";
			}

		}

	}