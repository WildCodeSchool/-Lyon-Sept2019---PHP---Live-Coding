<?php

require_once("functions.php");


if (!empty($_POST) && isset($_POST['register-submit'])) {

	$errors = [];
	$step = $_POST["step"];
	$firstname = "";
	if (isset($_POST['firstname']))
		$firstname = $_POST["firstname"];
	
	$lastname = "";
	if (isset($_POST['lastname']))
		$lastname = $_POST["lastname"];
	
	// $age = $_POST["age"];

	// Verification
	if ($step === 1) {	
		if (empty(trim($firstname))) {
			$errors["firstname"] = "Please fill your firstname";
		}
	}
	if ($step === 2) {	
		if (empty(trim($lastname))) {
			$errors["lastname"] = "Please fill your lastname";
		}
	}
	
	if ($step === 3) {	
		if ($age == "none") {
			$errors["age"] = "Please select your age";
		} elseif ($age == "-18") {
			$errors["age"] = "You're too young for this content";
		}
	}

	if (empty($errors)) {
		if ($step < 3) {
			$step += 1;
			// header("location:/index.php?step=$step");

		} else {
			header("location:/success.php?fn=$firstname&ln=$lastname");
		}
	} else {
		$queryString = arrayToQueryString($errors, "errors");
		$queryString .= arrayToQueryString($_POST, "formValues");
		// var_dump($queryString);
		header("location:/index.php?$queryString&step=$step");
		// var_dump($errors);
	}

}



?>