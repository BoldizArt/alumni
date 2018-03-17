<?php

	if ( !defined('ABSPATH')) {
	  die();
	}

	/**
	* Klasa koja proverava da li su uneti podaci sadrže običan tekst ili neki JavaScript kod itd.
	*/
	class proveraUnosa {

		public $unos;
		
		function __construct($unos)
		{
			$this->unos = $unos;
		}

		public function test_input() {
			$unos = strip_tags($this->unos);
			$unos = addcslashes($unos, "%=`<?>");
			$unos = trim($unos);
			$unos = stripslashes($unos);
			$unos = htmlspecialchars($unos);
			return $unos;
		}

	}