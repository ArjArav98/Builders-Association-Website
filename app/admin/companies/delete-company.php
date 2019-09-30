<?php

/**********************/
/* DELETE-COMPANY.PHP */
/**********************/

/* This file gets the ID of the company and deletes it from the COMPANIES table. */

/* We start the session and include the necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/company-listings.php';

/* We now get the necessary information through POST. */
$id = $_POST['companyId'];

/* We delete the company from the COMPANIES table in the database. */
deleteCompany($id);

/* We now redirect back to the ADMIN-COMPANIES-INDEX.PHP page. */
header('Location: index.php', true, 303);
die();

?>
