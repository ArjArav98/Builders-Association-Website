<?php

/***************************/
/* CANDIDATE-LISTINGS.PHP  */
/***************************/

/* This file contains libraries for retrieving, manipulating or deleting records from the candidate listings. */

/* We import the necessary php libraries. */
require 'sql-connections.php';
require 'sql-functions.php';
require 'data-validation.php';

/*-----------*/
/* Insertion */
/*-----------*/

/* This function inserts given candidate info into 'Unplaced Candidates' table. */
function insertCandidate($candidateInfo){

	/* We must first validate the information. */

	$autoIncValue = getCurrentAutoIncValue().".pdf";
	$rejectedCompanies = "0000 ";

	try {

		$connection = getConnection();
		$sqlstmt = "INSERT INTO UNPLACED_CANDIDATES VALUES (ID, ?, ?, ?, ?, ?, ?);";

		$sql = $connection->prepare($sqlstmt);
		$sql->bindParam(1, $candidateInfo[0]);
		$sql->bindParam(2, $candidateInfo[1]);
		$sql->bindParam(3, $candidateInfo[2]);
		$sql->bindParam(4, $candidateInfo[3]);
		$sql->bindParam(5, $autoIncValue);
		$sql->bindParam(6, $rejectedCompanies);
		$sql->execute();

		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/insertCandidate): $exception";
	}

}

insertCandidate(array("Arjun","8939227284","arjun@gmail.com","DIPLOMA"));

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
