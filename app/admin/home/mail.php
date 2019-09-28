<?php

require '../../../src/candidate-listings.php';

/************/
/* MAIL.PHP */
/************/

/* This function sends an e-mail to the candidate with the given information.  */
function sendInfoEmailToCandidate($candidateId) {

	$candidateEmailAddress = getCandidate($candidateId, NULL, NULL, NULL, NULL, 0, 1, 1)[3][0];
	$subject = "First E-Mail!";
	$message = "Hello World!";
	$headers = "From: Arjun Aravind <arjun.aravind1998@gmail.com>";

	mail("Arjun Aravind <arjun.aravind1998@gmail.com>", $subject, $message, $headers);

}

sendInfoEmailToCandidate(11);
?>
