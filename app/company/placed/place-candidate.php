<?php

/***********************/
/* PLACE-CANDIDATE.PHP */
/***********************/

session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';

$candidateId = $_GET['candidateId'];

placeCandidate($candidateId);

header('Location: index.php', true, 303);
die();

?>
