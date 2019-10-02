<?php

/***********************/
/* SUBMIT-FEEDBACK.PHP */
/***********************/

/* This file takes the data from the form and submits the feedback. */

/* We start the session and include the libraries. */
session_start();
require('../../../src/sql-connections.php');
require('../../../src/sql-functions.php');
require('../../../src/data-validation.php');
require('../../../src/candidate-listings.php');
require('../../../src/feedback.php');

/* We get the necessary data from the form. */
$candidateId = $_POST['candidateId'];
$message = $_POST['message'];

/* We check if the candidateId exists. */
if(sizeof(getCandidate($candidateId, NULL, NULL, NULL, NULL, 0, 0, 1)[0]) != 0) {
	submitFeedback($candidateId,$message);
}
else if(sizeof(getCandidate($candidateId, NULL, NULL, NULL, NULL, 0, 1, 1)[0]) != 0) {
	submitFeedback($candidateId,$message);
}
else {
	/* If it comes here, it's an error. */
}

/* We now redirect them to the feedback page. */
header("Location: index.html", true, 303);
die();

?>
