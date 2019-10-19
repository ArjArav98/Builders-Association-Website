<?php

/*************/
/* ERROR.PHP */
/*************/

/* This file contains functions which are related to error detection and reporting.  */

/* This function returns error strings based on the error number given in. */
function getError($errorNumber) {

	if($errorNumber == 1) {
		return "The username and the password do not match.";
	}
	else if($errorNumber == 2) {
		return "There is no company with the ID provided. Please check again.";
	}
	else if($errorNumber == 3) {
		return "Please provide a company ID.";
	}
	else if($errorNumber == 4) {
		return "Please provide a valid company name, username and password.";
	}


}

?>
