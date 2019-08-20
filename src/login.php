<?php

/*************/
/* LOGIN.PHP */
/*************/

/* This file contains information and functions for logging in. */

/* This function checks whether a given username/password are valid. */
function login($username, $password, $isCompany) {

	/* If the login is attempted by the admin... */
	if($isCompany == false) {
		if($username == "admin" && $password == "admin") { //Default login.
			return true;
		}
		return false;
	}

	/* If the login is attempted by a company...  */

	try {

		$connection = getConnection();
		$sqlstmt = "SELECT COUNT(*) AS LOGIN FROM COMPANIES WHERE USERNAME='$username' AND PASSWORD='$password';";

		$results = executeQuery($connection, $sqlstmt);
		$connection = NULL; //Closes connection.

		if($results[0]['LOGIN'] == 1) {
			return true;
		}
		else {
			return false;
		}

	} catch (PDOEXception $exception) {
		echo "Exception Thrown (login.php/login): $exception";
	}

	return false; //If something goes wrong.

}

?>
