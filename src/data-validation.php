<?php

/* We dont include any libraries here. When they're all included in candidate-listings.php, these functions will have access to the necessary libraries. */

/*************************/
/** DATA-VALIDATION.PHP **/
/*************************/

/* This function checks whether the number is valid or not. */
function numberIsValid($number) {

	if(preg_match('/(^[0-9]{10}$)|(^[0-9]{8}$)/',$number) == 1) {
		return true;
	}
	else {
		return false;
	}

}

/* This function checks whether given number exists in table or not. */
function numberDoesntExist($number) {

	try {

		$connection = getConnection(); //Creates connection.
		$sqlstmt = "SELECT COUNT(*) AS NUMCOUNT FROM UNPLACED_CANDIDATES WHERE NUMBER = '$number';";

		$results = executeQuery($connection, $sqlstmt);
		$connection = NULL; //Closes connection.

		if($results[0]['NUMCOUNT'] == 0) {
			return true;
		}
		else {
			return false;
		}

	} catch (PDOException $exception) {
		echo "Exception Thrown (data-validation.php/numberDoesntExist): $exception";
	}

	return false; //If there's an exception, then false.

}

/* This function checks whether the email is valid or not. */
function emailIsValid($email) {

	if(preg_match('/^[a-zA-Z0-9_\.]*@[a-zA-z0-9]*(\.[a-zA-Z]*)+$/',$email) == 1) {
		return true;
	}
	else {
		return false;
	}

}

?>
