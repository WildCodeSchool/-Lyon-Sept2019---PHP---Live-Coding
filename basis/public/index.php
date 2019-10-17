<?php
require_once '../connec.php';

$pdo = new PDO(DSN, USER, PASS);
$query = 'SELECT * FROM product';
$statement = $pdo->query($query);
$products = $statement->fetchAll(PDO::FETCH_ASSOC);


?>



<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	coucou!
	<?php foreach ($products as $product) { ?>
	
	<div class="card">
		<div class="img">
			<img src="https://via.placeholder.com/200" />
		</div>
		<div class="description">
			<div class="name">
				<h1><?= $product['name'] ?></h1>
				<p><?= $product['description'] ?></p>
			</div>
			<p class="price">$<?= $product['price'] ?></p>	
		</div>
	</div>
<?php } ?>
</body>
</html>