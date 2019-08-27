<?php

/***************************/
/* CANDIDATE-LISTINGS.PHP  */
/***************************/

/* This file contains libraries for retrieving, manipulating or deleting records from the candidate listings. */

/* We import the necessary php libraries. */
require '../../src/sql-connections.php';
require '../../src/sql-functions.php';
require '../../src/data-validation.php';

/*-----------*/
/* Insertion */
/*-----------*/

/* This function inserts given candidate info into 'Unplaced Candidates' table. */
function insertCandidate($name,$number,$email,$qualification){

	/* We must first validate the information. */
	/* If not valid, we return false. */

	if(numberIsValid($number) == false) {
		return false;
	}
	else if(numberDoesntExist($number) == false) {
		return false;
	}
	else if(emailIsValid($email) == false) {
		return false;
	}

	/* We initialise the following values. */
	
	$resumeName = getCurrentAutoIncValue().".pdf";
	$rejectedCompanies = "0000 ";

	/* Once everything is set, we insert into SQL table. */

	try {

		$connection = getConnection();
		$sqlstmt = "INSERT INTO UNPLACED_CANDIDATES VALUES (ID, ?, ?, ?, ?, ?, ?, 0, 0);";

		$sql = $connection->prepare($sqlstmt);
		$sql->bindParam(1, $name);
		$sql->bindParam(2, $number);
		$sql->bindParam(3, $email);
		$sql->bindParam(4, $qualification);
		$sql->bindParam(5, $resumeName);
		$sql->bindParam(6, $rejectedCompanies);
		$sql->execute();

		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/insertCandidate): $exception";
	}

	/* If successful, we return true. */
	return true;

}


/* Retrieves an array of candidates based on the filter and pagination options passed in. */
function getCandidate($name=NULL, $number=NULL, $email=NULL, $qualification=NULL, $referred=NULL, $placed=0, $paginationNum = 1) {

	/* We must first construct an SQL statement using the options passed in. */

	$sqlstmt = "SELECT ID, NAME, NUMBER, EMAIL, QUALIFICATION, RESUME FROM UNPLACED_CANDIDATES WHERE ";

	//We check for NAME.
	if($name != NULL) {
		$sqlstmt .= "NAME LIKE  '%$name%' ";
	}
	else {
		$sqlstmt .= "NAME LIKE '%' ";
	}

	//We check for NUMBER.
	if($number != NULL) {
		$sqlstmt .= "AND NUMBER LIKE '%$number%' ";
	}

	//We check for EMAIL.
	if($email != NULL) {
		$sqlstmt .= "AND EMAIL LIKE '%$email%' ";
	}

	//We check for QUALIFICATION.
	if($qualification != NULL) {
		$sqlstmt .= "AND QUALIFICATION LIKE '%$qualification%' ";
	}

	//We check for REFERRED_COMPANY.
	if($referred == NULL) {
		$sqlstmt .= "AND REFERRED_COMPANY IS NULL ";
	}
	if($referred != NULL) {
		$sqlstmt .= "AND REFERRED_COMPANY LIKE '$referred' ";
	}

	//We check for the PLACED column.
	if($placed == 0 || $placed == 1) {
		$sqlstmt .= "AND PLACED = $placed ";
	}

	//We now construct for the Pagination Limit.
	$paginationNum *= 100;
	$sqlstmt .= "LIMIT ".($paginationNum-10).",".($paginationNum).";";

	try {

		$connection = getConnection(); //Creates connection.

		$results = executeQuery($connection, $sqlstmt);
		$connection = NULL; //Closes connection.

		$id = array();
		$name = array();
		$number = array();
		$email = array();
		$qualification = array();
		$resume = array();

		foreach ($results as $row) {
			array_push($id,$row['ID']);
			array_push($name,$row['NAME']);
			array_push($number,$row['NUMBER']);
			array_push($email,$row['EMAIL']);
			array_push($qualification,$row['QUALIFICATION']);
			array_push($resume,$row['RESUME']);
		}

		return array($id,$name,$number,$email,$qualification,$resume);

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/getCandidate): $exception";
	}

	return false; //In case something goes wrong.

}

/* We refer the candidate to a particular company. */
function referCandidate($candidateId, $companyId){

	/* We simply update the REFERRED_COMPANY column of a candidate to that of the company's ID.*/
	try {

		$connection = getConnection();
		$sqlstmt = "UPDATE UNPLACED_CANDIDATES SET REFERRED_COMPANY = '$companyId' WHERE ID = $candidateId;";

		$sql = $connection->prepare($sqlstmt);
		$sql->execute();
		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/referCandidate): $exception";
	}

}

/* We refer the candidate to a particular company. */
function placeCandidate($candidateId){

	/* We simply update the REFERRED_COMPANY column of a candidate to that of the company's ID.*/
	try {

		$connection = getConnection();
		$sqlstmt = "UPDATE UNPLACED_CANDIDATES SET PLACED=1 WHERE ID=$candidateId;";

		$sql = $connection->prepare($sqlstmt);
		$sql->execute();
		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/referCandidate): $exception";
	}

}

/* We reject the candidate from a particular company. */
function rejectCandidate($candidateId){

	/* We simply update the REFERRED_COMPANY column of a candidate to that of the company's ID.*/
	try {

		$connection = getConnection();
		$sqlstmt = "UPDATE UNPLACED_CANDIDATES SET REFERRED_COMPANY=NULL WHERE ID=$candidateId;";

		$sql = $connection->prepare($sqlstmt);
		$sql->execute();
		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/referCandidate): $exception";
	}

}

/*-----------*/
/* Utilities */
/*-----------*/

/* This function returns the current Auto-Increment value from the given table. */
function getCurrentAutoIncValue(){

	try {

		$conn = getConnection(); //Creates connection.
		$sqlstmt = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'BUILDERS_ASSOCIATION' AND TABLE_NAME = 'UNPLACED_CANDIDATES';";

		$results = executeQuery($conn, $sqlstmt);
		$conn = NULL; //Closes connection.

		return $results[0]['AUTO_INCREMENT']; //Returns auto_increment value of 1st row.

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/getCurrentAutoIncValue): $exception";
		return -1;
	}

}

/* This function returns the company ID of the given username and password. */
function getCompanyId($username,$password) {

	try {

		$conn = getConnection(); //Creates connection.
		$sqlstmt = "SELECT ID FROM COMPANIES WHERE USERNAME='$username' AND PASSWORD='$password';";

		$results = executeQuery($conn, $sqlstmt);
		$conn = NULL; //Closes connection.

		return $results[0]['ID']; //Returns auto_increment value of 1st row.

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/getCompanyId): $exception";
		return -1;
	}

}

?>
