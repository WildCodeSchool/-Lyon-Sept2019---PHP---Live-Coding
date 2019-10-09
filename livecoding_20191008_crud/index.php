<?php

require_once("connec.php");

$pdo = new PDO(DSN, USER, PASS);

// Si on submit un des form delete
if (isset($_POST['delete'])) {
	// On récupère l 'ID de l'article stocké dans notre input Hidden
	$articleId = $_POST['id'];
	// On crée la requete qui supprimer notre article en base
	$query = "DELETE FROM article WHERE id=:id";
	$statement = $pdo->prepare($query);
	// On bind l'ID de notre article au placeholder de la query
	$statement->bindValue(":id", $articleId, PDO::PARAM_INT);
	// On execute
	$statement->execute();
}

// On récupère la liste de tous nos articles
$query = "SELECT * FROM article";
$statement = $pdo->query($query);
// On utilise un fetchall pour récupérer les articles sous form d'array
// Le param FETCH_ASSOC permet de retourner seulement un tableau associatif (au lieu d'un tableau associatif + numerique pour le param par defaut FETCH_BOTH)
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include_once("header.php"); ?>

	<h3>Articles List</h3>
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Title</th>
				<th>Author</th>
				<th>Actions</th>
			</tr>
		</thead>
		<?php
			foreach ($articles as $article) {
		?>

		<tr>
			<th><?= $article['id'] ?></th>
			<td>
				<strong><?= $article['title'] ?></strong><br/>
				<p><?= $article['content'] ?></p>
			</td>
			<td><?= $article['author'] ?></td>
			<td>
				<a href="/edit.php?id=<?= $article['id'] ?>" class="btn btn-primary">Edit</a>
				<form action="index.php" method="POST">
					<input type="hidden" value="<?= $article['id'] ?>" />
					<input type="submit" class="btn btn-danger" value="Delete">
				</form>
			</td>
		</tr>
	</table>


<?php include_once("footer.php"); ?>