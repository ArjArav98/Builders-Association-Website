<?php

/************/
/* MAIL.PHP */
/************/

/* This function sends an e-mail to the candidate with the given information. */
/* We simply execute a python file with the email as a command-line argument. */
function sendInfoEmailToCandidate($candidateEmailAddress) {
	system(getenv("PYTHON_PATH")." ../../../mail/mail.py $candidateEmailAddress");
}

function generateEmailResponse($companyId) {
	$companyDetails = getCompanies($companyId,NULL,NULL);

	$mailStr = "Messrs ".$companyDetails[1][0].",<br>";
	$mailStr .= "Thank you for reaching out to us. The requested candidates have been referred to your account on the website. Please log in with the following details.<br><br>Account Username: ".$companyDetails[2][0]."<br>Account Password: ".$companyDetails[3][0]."<br><br>Yours sincerely,<br>Builders Association of India";

	return $mailStr;
}

?>
