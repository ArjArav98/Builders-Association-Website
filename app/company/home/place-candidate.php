<?php

/***********************/
/* PLACE-CANDIDATE.PHP */
/***********************/

session_start();
require '../../../src/candidate-listings.php';

$candidateId = $_POST['candidateId'];

placeCandidate($candidateId);

header('Location: index.php', true, 303);
die();

?>
