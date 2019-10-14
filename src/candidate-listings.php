<?php

/***************************/
/* CANDIDATE-LISTINGS.PHP  */
/***************************/

/* This file contains libraries for retrieving, manipulating or deleting records from the candidate listings. */

/*-----------*/
/* Insertion */
/*-----------*/

/* This function inserts given candidate info into 'Unplaced Candidates' table. */
function insertCandidate($name,$number,$email,$qualification,$experience,$district,$resumeName){

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

	/*-----------------------------------------------------------------------*/
	/* We must first construct an SQL statement using the options passed in. */
	/*-----------------------------------------------------------------------*/

	$sqlstmt = "";

	/*-----------------------------------------------------------------------------------*/
	/* We check for several condtns such as whether full profile is needed, placed, etc. */
	/*-----------------------------------------------------------------------------------*/

	$sqlstmt .= ($viewFullProfile == 0)? "SELECT ID, NAME, QUALIFICATION, EXPERIENCE, DISTRICT " : "SELECT ID, NAME, NUMBER, EMAIL, QUALIFICATION, EXPERIENCE, DISTRICT, RESUME ";
	$sqlstmt .= ($placed == 0)? "FROM UNPLACED_CANDIDATES WHERE " : "FROM PLACED_CANDIDATES WHERE ";
	$sqlstmt .= ($qualification != NULL)? "QUALIFICATION = '$qualification' " : "QUALIFICATION LIKE '%' ";
	$sqlstmt .= ($id != NULL)? "AND ID = $id " : "";
	$sqlstmt .= ($experience != NULL)? "AND EXPERIENCE = '$experience' " : "";
	$sqlstmt .= ($district != NULL)? "AND DISTRICT = '$district' " : "";
	
	/* We check for REFERRED_COMPANY. */
	
	$sqlstmt .= ($referred == NULL && $placed == 0)? "AND REFERRED_COMPANY IS NULL " : "";
	if($referred != NULL && $placed == 0) {
		$sqlstmt .= ($referred == "ALL")? "" : "AND REFERRED_COMPANY LIKE '$referred' ";
	}
	if($referred != NULL && $placed == 1) {
		$sqlstmt .= ($referred == "ALL")? "" : "AND COMPANY = $referred ";
	}

	//$paginationNum *= 1000;
	//$sqlstmt .= "LIMIT ".($paginationNum-100).",".($paginationNum).";";
	$sqlstmt .= ";";
	
	/*---------------------------------------*/
	/* We now take the query and execute it. */
	/*---------------------------------------*/

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

?>
