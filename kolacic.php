<?php

	$cookie_name = "email";
	$cookie_value = $email;
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>