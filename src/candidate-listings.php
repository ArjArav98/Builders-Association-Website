<?php

/***************************/
/* CANDIDATE-LISTINGS.PHP  */
/***************************/

/* This file contains libraries for retrieving, manipulating or deleting records from the candidate listings. */

/*-----------*/
/* Insertion */
/*-----------*/

/* This function inserts given candidate info into 'Unplaced Candidates' table. */
function insertCandidate($name,$number,$email,$qualification,$experience,$district){

	/* We must first validate the information. */
	/* If not valid, we return false. */
	if(numberIsValid($number) == false) {
		return;
	}
	else if(numberDoesntExist($number) == false) {
		return;
	}
	else if(emailIsValid($email) == false) {
		return;
	}

	/* We initialise the following values. */
	$resumeName = getCurrentAutoIncValue().".pdf";

	/* Once everything is set, we insert into SQL table. */
	try {

		$connection = getConnection();
		$sqlstmt = "INSERT INTO UNPLACED_CANDIDATES VALUES (ID, ?, ?, ?, ?, ?, ?, ?, REFERRED_COMPANY);";

		$sql = $connection->prepare($sqlstmt);
		$sql->bindParam(1, $name);
		$sql->bindParam(2, $number);
		$sql->bindParam(3, $email);
		$sql->bindParam(4, $qualification);
		$sql->bindParam(5, $experience);
		$sql->bindParam(6, $district);
		$sql->bindParam(7, $resumeName);
		$sql->execute();

		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/insertCandidate): $exception";
	}

}

/* Retrieves an array of candidates based on the filter and pagination options passed in. */
function getCandidate($id=NULL, $qualification=NULL, $experience=NULL, $district=NULL, $referred=NULL, $placed=0, $viewFullProfile=0, $paginationNum = 1) {

	/* We must first construct an SQL statement using the options passed in. */
	/* We construct the SQL statement by checking the options with if conditions. */

	$sqlstmt = "";

	/* We first check if the full profile is needed to be viewed or not. */
	if($viewFullProfile == 0) {
		$sqlstmt = "SELECT ID, NAME, QUALIFICATION, EXPERIENCE, DISTRICT ";
	}
	else {
		$sqlstmt = "SELECT ID, NAME, NUMBER, EMAIL, QUALIFICATION, EXPERIENCE, DISTRICT, RESUME ";
	}

	/* We check if the candidate is placed or not. */
	if($placed == 0) {
		$sqlstmt .= "FROM UNPLACED_CANDIDATES WHERE ";
	}
	else {
		$sqlstmt .= "FROM PLACED_CANDIDATES WHERE ";
	}

	/* We check for QUALIFICATION. */
	if($qualification != NULL) {
		$sqlstmt .= "QUALIFICATION = '$qualification' ";
	}
	else {
		$sqlstmt .= "QUALIFICATION LIKE '%' ";
	}

	/* We check if some ID is there. */
	if($id != NULL) {
		$sqlstmt .= "AND ID = $id ";
	}

	/* We check for EXPERIENCE. */
	if($experience != NULL) {
		$sqlstmt .= "AND EXPERIENCE = '$experience' ";
	}

	/* We check for DISTRICT. */
	if($district != NULL) {
		$sqlstmt .= "AND DISTRICT = '$district' ";
	}

	/* We Check for REFERRED_COMPANY. */
	if($referred == NULL && $placed == 0) {
		$sqlstmt .= "AND REFERRED_COMPANY IS NULL ";
	}
	if($referred != NULL && $placed == 0) {
		$sqlstmt .= "AND REFERRED_COMPANY LIKE '$referred' ";
	}
	if($referred != NULL && $placed == 1) {
		$sqlstmt .= "AND COMPANY = $referred ";
	}

	/* We now construct for the Pagination Limit. */
	$paginationNum *= 100;
	$sqlstmt .= "LIMIT ".($paginationNum-100).",".($paginationNum).";";
	
	try {

		$connection = getConnection(); //Creates connection.

		$results = executeQuery($connection, $sqlstmt);
		$connection = NULL; //Closes connection.

		//Depending on whether we want to get the full profile or not...
		if($viewFullProfile == 0) { //If we do not want the full profile...

			$id = array();
			$name = array();
			$qualification = array();
			$experience = array();
			$district = array();

			foreach ($results as $row) {
				array_push($id,$row['ID']);
				array_push($name,$row['NAME']);
				array_push($qualification,$row['QUALIFICATION']);
				array_push($experience,$row['EXPERIENCE']);
				array_push($district,$row['DISTRICT']);
			}

			return array($id,$name,$qualification,$experience,$district);

		}
		else { //If we want the full profile...

			$id = array();
			$name = array();
			$number = array();
			$email = array();
			$qualification = array();
			$experience = array();
			$district = array();
			$resume = array();

			foreach ($results as $row) {
				array_push($id,$row['ID']);
				array_push($name,$row['NAME']);
				array_push($number,$row['NUMBER']);
				array_push($email,$row['EMAIL']);
				array_push($qualification,$row['QUALIFICATION']);
				array_push($experience,$row['EXPERIENCE']);
				array_push($district,$row['DISTRICT']);
				array_push($resume,$row['RESUME']);
			}

			return array($id,$name,$number,$email,$qualification,$experience,$district,$resume);

		}

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/getCandidate): $exception";
	}

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

	/* We must first extract details of the candidate from the UNPLACED_CANDIDATES table. */
	/* We must then insert this as a row into the PLACED_CANDIDATES table. */
	/* We then delete the candidate from the UNPLACED_CANDIDATES table. */
	try {

		$connection = getConnection();

		$sqlstmt = "INSERT INTO PLACED_CANDIDATES (ID, NAME, NUMBER, EMAIL, QUALIFICATION, EXPERIENCE, DISTRICT, RESUME, COMPANY) SELECT ID, NAME, NUMBER, EMAIL, QUALIFICATION, EXPERIENCE, DISTRICT, RESUME, REFERRED_COMPANY FROM UNPLACED_CANDIDATES WHERE ID = $candidateId;";
		$sql = $connection->prepare($sqlstmt);
		$sql->execute();

		$sqlstmt = "DELETE FROM UNPLACED_CANDIDATES WHERE ID = $candidateId;";
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

/* This function returns the company name when the ID is given. */
function getCompanyName($companyId) {

	try {

		$conn = getConnection(); //Creates connection.
		$sqlstmt = "SELECT NAME FROM COMPANIES WHERE ID=$companyId;";

		$results = executeQuery($conn, $sqlstmt);
		$conn = NULL; //Closes connection.

		return $results[0]['NAME']; //Returns auto_increment value of 1st row.

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/getCompanyName): $exception";
		return -1;
	}

}

?>
