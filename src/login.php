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


/* This function checks whether a user is logged in or not. Makes use of SESSION variables. */
function isNotLoggedIn() {
	if(!isset($_SESSION["LOGGED_IN"])) {
		return true;
	}
	
	return false;
}

/* This function redirects to the login page. */
function redirectToLogin() {
	header("Location: ../login/index.html", true, 303);
	die();
}

/* This function redirects to the login page from the candidate details page. */
function redirectToLoginFromCandidate() {
	header("Location: ../../company/login/index.html", true, 303);
	die();
}
?>
