<?php

/*******************/
/* LOGIN-INDEX.PHP */
/*******************/

/* This file takes in data from the login form and authenticates it. */

/* We start the SESSION and remove all previously-set SESSION variables. */
session_start();
session_unset();

/* We include the necessary libraries. */
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/login.php';

/* We get the ADMIN login details. */
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

/* Authenticate the admin login details. */
if(login($username,$password,false) == true) {

	/* We set the SESSION variables for filtering options to false. */
	$_SESSION["SEARCH_QUALIFICATION"] = NULL;
	$_SESSION["SEARCH_EXPERIENCE"] = NULL;
	$_SESSION["SEARCH_DISTRICT"] = NULL;
	$_SESSION["HISTORY_SEARCH"] = NULL;

	/* We redirect to the 'ADMIN HOME' page. */
	header('Location: ../home/index.php', true, 303);
	die();
}
else {
	/* We redirect to the login page. */
	header('Location: index.html', true, 303);
	die();
}

/*******/
/* END */
/*******/

?>
