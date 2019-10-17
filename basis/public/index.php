<?php
require_once '../connec.php';
require_once 'Product.php';

$pdo = new PDO(DSN, USER, PASS);
$query = 'SELECT * FROM product';
$statement = $pdo->query($query);
$products = $statement->fetchAll(PDO::FETCH_ASSOC);
$productsObjects = [];
foreach ($products as $product) {
	$productsObjects[] = new Product($product['name'], $product['description'], $product['price']);
}
// var_dump($productsObjects);

?>



<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php foreach ($productsObjects as $product) { ?>
	
	<div class="card">
		<div class="img">
			<img src="https://via.placeholder.com/200" />
		</div>
		<div class="description">
			<div class="name">
				<h1><?= $product->getName() ?></h1>
				<p><?= $product->getDescription() ?></p>
			</div>
			<p class="price">$<?= $product->getPrice() ?></p>	
		</div>
	</div>
<?php } ?>
</body>
</html>