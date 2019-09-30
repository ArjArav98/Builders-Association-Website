<?php

/*********************/
/* REFER-COMPANY.PHP */
/*********************/

/* This file takes in the company along with the candidate and 'refers' the candidate to that company. */

/* We start the session and include the necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';

/* We get the required data from the 'refer company' form. */
$candidateId = $_GET['candidateid'];
$companyId = $_GET['companyid'];

/* We invoke the referCandidate() func. */
referCandidate($candidateId, $companyId);

/* We redirect back to the ADMIN-HOME page. */
header('Location: index.php', true, 303);
die();

?>
