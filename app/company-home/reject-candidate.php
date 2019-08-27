<?php

/***********************/
/* PLACE-CANDIDATE.PHP */
/***********************/

session_start();
require '../../src/candidate-listings.php';

$candidateId = $_GET['candidateId'];

rejectCandidate($candidateId);

header('Location: index.php', true, 303);
die();

?>
