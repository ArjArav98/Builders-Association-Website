<?php

/********************/
/* ADMIN-FILTER.PHP */
/********************/

/* This file takes in the search options from the form and prcesses them. */

/* We start the session. */
session_start();

/* We store the necessary filtering options in SESSION variables. */
$_SESSION["SEARCH_NAME"] = $_REQUEST["name"];
$_SESSION["SEARCH_NUMBER"] = $_REQUEST["number"];
$_SESSION["SEARCH_EMAIL"] = $_REQUEST["email"];

if($_REQUEST["qualification"] == "NULL"){
	$_SESSION["SEARCH_QUALIFICATION"] = NULL;
}
else {
	$_SESSION["SEARCH_QUALIFICATION"] = $_REQUEST["qualification"];
}

/* We finally redirect to the 'ADMIN HOME' page. */
/* We use a 303-code to implement POST-GET-Redirect. */
header('Location: index.php', true, 303);
die();

/*******/
/* END */
/*******/

?>
