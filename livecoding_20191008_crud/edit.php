<?php

require_once("connec.php");

$pdo = new PDO(DSN, USER, PASS);

// Si on arrive sur notre page en GET, on récupère les datas de l'article que l'on souhaite modifier
if ($_SERVER["REQUEST_METHOD"] === "GET") {

  // On crée notre requete pour récupérer notre article
	$query = 'SELECT * FROM article WHERE id=:id';
	$statement = $pdo->prepare($query);

  // On récupère l ID de l'article depuis les paramètres de l'URL
	$articleId = $_GET["id"];

  // On remplace le placeholder par l'ID de notre article
	$statement->bindValue(':id', $articleId, PDO::PARAM_INT);
  // On exécute notre requete SQL
	$statement->execute();

  // On retourne la première ligne des enregistrements (en l'occurence, on n'en a qu'un seul, puisque les IDs sont uniques dans notre table)
	$article = $statement->fetch(PDO::FETCH_ASSOC);

  // Si notre article n'a pas été trouvé, on affiche un petit message et un lien pour revenir sur la liste des articles
	if (!$article) {
		echo "<h1>Article not found</h1><a href='/index.php'>Go back to list</a>";
		exit();
	}
}

?>


<?php include_once 'header.php' ?>


<h1>Edit article #<?= $article["id"] ?></h1>

<form method="POST" action="create.php">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="<?= $article['title'] ?>">
  </div>
  <div class="form-group">
    <label for="author">Author</label>
    <input type="text" class="form-control" id="author" name="author" placeholder="Enter Author" value="<?= $article['author'] ?>">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
   <textarea class="form-control" id="content" name="content" rows="3"><?= $article['content'] ?></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Save article</button>
</form>


<?php include_once 'footer.php' ?>