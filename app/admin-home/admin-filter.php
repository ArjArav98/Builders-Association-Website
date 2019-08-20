<?php
session_start();

$_SESSION["SEARCH_NAME"] = $_REQUEST["name"];
$_SESSION["SEARCH_NUMBER"] = $_REQUEST["number"];
$_SESSION["SEARCH_EMAIL"] = $_REQUEST["email"];

if($_REQUEST["qualification"] == "NULL"){
	$_SESSION["SEARCH_QUALIFICATION"] = NULL;
}
else {
	$_SESSION["SEARCH_QUALIFICATION"] = $_REQUEST["qualification"];
}

echo "<script>window.location.href='index.php';</script>";

?>
