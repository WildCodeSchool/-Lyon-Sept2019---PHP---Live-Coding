<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
	<body>
	<div class="panel" style="width:50%;margin:auto;margin-top:40px;">
	<p class="panel-heading">
    	Formulaire d'inscription
	</p>
	<div class="panel-block">
		<p>Merci de compléter le form ci dessous:</p>
	</div>
	<div class="panel-block">
		<?php include("form.php") ?>
	</div>
</div>
	</body>
</html>