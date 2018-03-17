
<?php
if ( !defined('ABSPATH')) {
	die();
}

$con = new mysqli($config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['name']);
mysqli_set_charset($con, 'utf8');

if (mysqli_connect_errno()) {
	die();
}
?>