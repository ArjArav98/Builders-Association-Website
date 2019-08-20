<?php

session_start();
require '../../src/login.php';

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

/* Authenticate the admin login details. */
if(login($username,$password,false) == true) {

	/* We set some SESSION variables. */
	$_SESSION["SEARCH_NAME"] = NULL;
	$_SESSION["SEARCH_NUMBER"] = NULL;
	$_SESSION["SEARCH_EMAIL"] = NULL;
	$_SESSION["SEARCH_QUALIFICATION"] = NULL;

	echo "<script>window.location.href='../admin-home/index.php';</script>";
}
else {
	echo "<script>window.location.href='index.html';</script>";
}

?>
