<?php

/********************/
/* ADMIN-FILTER.PHP */
/********************/

/* This file takes in the search options from the form and prcesses them. */

/* We start the session. */
session_start();

/* We store the necessary filtering options in SESSION variables. */
$_SESSION["SEARCH_NAME"] = $_GET["name"];
$_SESSION["SEARCH_NUMBER"] = $_GET["number"];
$_SESSION["SEARCH_EMAIL"] = $_GET["email"];

if($_REQUEST["qualification"] == "NULL"){
	$_SESSION["SEARCH_QUALIFICATION"] = NULL;
}
else {
	$_SESSION["SEARCH_QUALIFICATION"] = $_REQUEST["qualification"];
}

/* We finally redirect to the 'ADMIN HOME' page. */
/* We use a 303-code to implement GET-GET-Redirect. */
header('Location: index.php', true, 303);
die();

/*******/
/* END */
/*******/

?>
