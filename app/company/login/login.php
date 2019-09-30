<?php

/*******************/
/* LOGIN-INDEX.PHP */
/*******************/

/* This file gets the company login details and authenticates them. */

/* We start the SESSION and remove any previously-set SESSION variables. */
session_start();
session_unset();

/* We include the necessary libraries. */
require '../../../src/login.php';
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';
require '../../../src/company-listings.php';

/* We get the login details from the login form. */
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];

/* We authenticate the login details for the company. */
if(login($username,$password,true) == true) {

	$_SESSION["LOGGED_IN"] = 1;
	$_SESSION["COMPANY_ID"] = getCompanies(NULL,$username,$password)[0][0];

	/* If authenticated, we redirect to the 'COMPANY HOME' page. */
	header('Location: ../home/index.php', true, 303);
	die();
}
else {
	/* If not, we redirect to the 'COMPANY LOGIN' page.*/
	header('Location: index.html', true, 303);
	die();
}

/*******/
/* END */
/*******/

?>
