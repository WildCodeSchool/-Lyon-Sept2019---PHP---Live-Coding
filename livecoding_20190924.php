<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style rel="stylesheet">
		li {
			color: grey;
		}
		body {
			padding: 40px;
		}
	</style>

</head>
<body>

<?php

/***

***/


$floors = [
	"Réception" => [
		"Jean" => 56,
		"Marie" => 23,
		"Steven" => 18
	],
	"Marketing" => [
		"Pierre" => 68,
		"Paul" => 23,
		"Jacques" => 44
	],
	"Commercial" => [
		"Juliette" => 12
	],
	"IT Department" => [
		"xecko" => "??",
		"zebra" => "??"
	],
];


// Calcule la moyenne d'un tableau d'entiers
function calcAverage(array $ages) : float {
	$average = 0;

	for ($i = 0; $i < count($ages); $i++) {
		if (is_numeric($ages[$i])) {
			$average += $ages[$i];
		}
	}

	$average = $average / count($ages);

	// On retourne la valeur arrondie
	return floor($average); 
}

$floor = 0;
$averages = [];

// On calcule la moyenne d'age pour chaque département
foreach($floors as $department => $members) {
	$ages = [];
	foreach ($members as $member => $age) {
		$ages[] = $age;
	}
	$average = calcAverage($ages);
	$averages[$department] = $average;
}

// On trie le tableau en fonction des values (= des moyennes d'age)
asort($averages);

// On utilise le tableau trié pour afficher les informations des départements
foreach ($averages as $department => $average) {

	// On récupère la liste des membres depuis le tableau original
	$members = $floors[$department];

	echo $floor . ' - <span class="badge badge-secondary">' . $department . '</span>';
	echo '<br>';
	
	foreach ($members as $member => $age) {
		echo "<li>" . $member . ' (' . $age .'), </li>';
	}

	if ($average != 0) {
		echo "Average: " . ($average);
	} else {
		echo "Average: ??";
	}

	echo '<br>';
	echo '<br>';
	$floor++;
}

?>

</body>

</html>
