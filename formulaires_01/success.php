<?php

$firstname = "";
if (isset($_GET["fn"]))
	$firstname = $_GET["fn"];

$lastname = "";
if (isset($_GET["ln"]))
	$lastname = $_GET["ln"];

?>

<html>
	<body>
		<p>Bravo <?= "$firstname $lastname" ?> !!!</p>
	</body>
</html>