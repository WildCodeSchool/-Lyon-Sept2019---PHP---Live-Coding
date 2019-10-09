<?php

require_once("connec.php");

if (!empty($_POST)) {
	// On vérifie la validité de nos données
	if (
		!empty(trim($_POST["title"])) &&
		!empty(trim($_POST["author"])) &&
		!empty(trim($_POST["content"]))
	) {
		$pdo = new PDO(DSN, USER, PASS);

		// On crée notre requete pour insérer notre article en base
		$query = "INSERT INTO article (title, author, content) VALUES (:title, :author, :content)";
		// On prépare notre requete
		$statement = $pdo->prepare($query);
		// On lie les placeholders à nos valeurs récupérées depuis le formulaire  
		$statement->bindValue(':title', $_POST["title"], PDO::PARAM_STR);
		$statement->bindValue(':author', $_POST["author"], PDO::PARAM_STR);
		$statement->bindValue(':content', $_POST["content"], PDO::PARAM_STR);
		// On exécute notre requete
		$statement->execute();
		// On redirige vers notre index
		header('location:/index.php');
		exit();
	}
}

?>

<?php include_once 'header.php' ?>

<h3>Create new article</h3>

<form method="POST" action="create.php">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label for="author">Author</label>
    <input type="text" class="form-control" id="author" name="author" placeholder="Enter Author">
  </div>
  <div class="form-group">
    <label for="content">Content</label>
   <textarea class="form-control" id="content" name="content" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Create article</button>
</form>

<?php include_once 'footer.php' ?>