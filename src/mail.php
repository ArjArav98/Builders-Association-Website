<?php

/************/
/* MAIL.PHP */
/************/

/* This function sends an e-mail to the candidate with the given information. */
/* We simply execute a python file with the email as a command-line argument. */
function sendInfoEmailToCandidate($candidateId) {
	$candidateEmailAddress = getCandidate($candidateId, NULL, NULL, NULL, NULL, 0, 1, 1)[3][0];
	system("python3 ../../../mail/mail.py $candidateEmailAddress");
}

function generateEmailResponse($companyId) {

}

?>
