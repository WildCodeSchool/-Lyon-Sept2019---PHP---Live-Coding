<?php

if (!empty($_POST) && isset($_POST['register-submit'])) {

	$errors = [];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$age = $_POST["age"];

	// Verification
	if (empty(trim($firstname))) {
		$errors["firstname"] = "Please fill your firstname";
	}
	if (empty(trim($lastname))) {
		$errors["lastname"] = "Please fill your lastname";
	}
	if ($age == "none") {
		$errors["age"] = "Please select your age";
	} elseif ($age == "-18") {
		$errors["age"] = "You're too young for this content";
	}

	if (empty($errors)) {
		header("location:/success.php?fn=$firstname&ln=$lastname");
	} else {
		$queryString = "";
		foreach ($errors as $field => $error) {
			if ($queryString != "") {
				$queryString .= "&";
			}
			$queryString .= "errors[$field]=" . urlencode($error);
		}
		foreach ($_POST as $field => $value) {
			if ($queryString != "") {
				$queryString .= "&";
			}
			$queryString .= "formValues[$field]=" . urlencode($value);
		}
		var_dump($queryString);
		header("location:/index.php?$queryString");
		// var_dump($errors);
	}

}



?>