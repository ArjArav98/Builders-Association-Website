<?php

/*******************/
/* ADD-COMPANY.PHP */
/*******************/

/* This file gets the necessary information through POST and adds a company into the COMPANIES table. */

/* We start the session and include the necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/company-listings.php';

/* We now get the necessary information through POST. */
$name = $_POST['name'];
$username = $_POST['username'];
$password  = $_POST['password'];

/* We insert the company into the COMPANIES table in the database. */
insertCompany($name,$username,$password);

/* We now redirect back to the ADMIN-COMPANIES-INDEX.PHP page. */
header('Location: index.php', true, 303);
die();

?>
