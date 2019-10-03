<?php

function arrayToQueryString(array $tab, string $tabName) : string
{
	$queryString = "";
	foreach ($tab as $field => $value) {
		if ($queryString != "") {
			$queryString .= "&";
		}
		$queryString .= "$tabName" . "[$field]=" . urlencode($value);
	}
	return $queryString;
}
