<?php

/***********************/
/* PLACE-CANDIDATE.PHP */
/***********************/

/* We start the session and include the necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';
require '../../../src/company-listings.php';
require '../../../src/logger.php';

/* We then get the required data and reject the candidate. */
$candidateId = $_POST['candidateId'];
rejectCandidate($candidateId);

/* We then proceed to log the placement. */
$candidateName = getCandidate($candidateId,NULL,NULL,NULL,NULL,0,0,1)[1][0];
rejectionLog($candidateName,$candidateId,getCompanies($_SESSION['COMPANY_ID'],NULL,NULL)[1][0],$_SESSION['COMPANY_ID']);

/* We then redirect to the INDEX.PHP page. */
header('Location: index.php', true, 303);
die();

?>
