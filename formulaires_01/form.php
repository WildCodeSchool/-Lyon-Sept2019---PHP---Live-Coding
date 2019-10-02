<?php
$errors = [];
if (isset($_GET["errors"]))
	$errors = $_GET["errors"];

$formValues = [];
$ageValue = "none";
if (isset($_GET["formValues"])) {
	$formValues = $_GET["formValues"];
	$ageValue = $formValues["age"];
}
?>

<form method="POST" action="action.php">
	<div class="field">
	  <label class="label" for="firstname">Firstname</label>
	  <div class="control">
	    <input 
	    	required
	    	id="firstname"
	    	name="firstname"
	    	class="input <?php if (isset($errors['firstname'])) echo 'is-danger'; ?>" type="text" placeholder="John"
	    	value="<?php if (isset($formValues['firstname'])) echo $formValues['firstname']; ?>"
	    >
	    <p style="color:red;"><?php if (isset($errors["firstname"])) echo $errors['firstname']; ?></p>
	  </div>
	</div>

	<div class="field">	
	<div class="field">
	  <label class="label" for="lastname">lastname</label>	  <div class="control">
	  	<input required id="lastname" name="lastname" class="input <?php if (isset($errors['lastname'])) echo 'is-danger'; ?>" type="text" placeholder="Doe"
	  	value="<?php if (isset($formValues['lastname'])) echo $formValues['lastname']; ?>">
	    <p style="color:red;"><?php if (isset($errors["lastname"])) echo $errors['lastname']; ?></p>
	    

	  </div>
	</div>

	<div class="select <?php if (isset($errors['age'])) echo 'is-danger'; ?>">
		<select	name="age">
			<option 
			<?php if ($ageValue == "none") echo "selected"; ?>
			value="none">Select your age...</option>
			<option
			<?php if ($ageValue == "-18") echo "selected"; ?>
			 value="-18">&lt; 18 ans</option>
			<option
			<?php if ($ageValue == "18-25") echo "selected"; ?>
			value="18-25">18 - 25 ans</option>
			<option
			<?php if ($ageValue == "25-50") echo "selected"; ?>
			value="25-50">25 - 50 ans</option>
			<option
			<?php if ($ageValue == "50+") echo "selected"; ?>
			value="50+">&gt; 50 ans</option>
		</select>
	    <p style="color:red;"><?php if (isset($errors["age"])) echo $errors['age']; ?></p>
	</div>
	<button class="button" type="submit" name="register-submit" value="register">Register!</button>
</form>