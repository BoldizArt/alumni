<?php

for ($i=0; $i < 23; $i++) { 
	if ($i%2 >0) {
		echo $i . "<br>";
	}
	else
	{
		echo "<b>" . $i . "</b><br>";
	}
	
}
/*
$query = "SELECT * FROM objave ORDER BY id DESC";
$query_result = $con->query($query);

while ($rows = mysqli_fetch_array($query_result)>0) {
	$idobjave = $rows['idobjave'];
	$naslov = $rows['naslov'];
	$tekstobjave = $rows['tekstobjave'];

	if ($idobjave%2 >0) {
		echo $idobjave . "<br>";
	}
	else
	{
		echo "<b>" . $idobjave . "</b><br>";
	}
}
*/
?>