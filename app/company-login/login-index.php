<?php

session_start();
require '../../src/login.php';
require '../../src/candidate-listings.php';

session_unset(); /* We remove all SESSION variables. */

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];

if(login($username,$password,true) == true) {
	$_SESSION["COMPANY_ID"] = getCompanyId($username,$password);
	echo "<script>window.location.href='../company-home/index.php';</script>";
}
else {
	echo "<script>window.location.href='index.html';</script>";
}

?>
