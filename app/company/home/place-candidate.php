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
require '../../../src/logger.php';

/* We get the required data and place the candidate. */
$candidateId = $_POST['candidateId'];
placeCandidate($candidateId);

/* We then proceed to log the placement. */
$candidateName = getCandidate($candidateId,NULL,NULL,NULL,NULL,1,0,1)[1][0];
echo $candidateName;
placementLog($candidateName,getCompanyName($_SESSION['COMPANY_ID']),$_SESSION['COMPANY_ID']);

/* We then redirect to the INDEX.PHP file. */
header('Location: index.php', true, 303);
die();

?>
