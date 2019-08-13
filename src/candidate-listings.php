<?php

/***************************/
/* CANDIDATE-LISTINGS.PHP  */
/***************************/

/* This file contains libraries for retrieving, manipulating or deleting records from the candidate listings. */

/* We import the necessary php libraries. */
require 'sql-connections.php';
require 'sql-functions.php';

/*-----------*/
/* Insertion */
/*-----------*/

function insertCandidate(){

	try {

		$conn = getConnection();
		$sqlstmt = "INSERT INTO ";


	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/insertCandidate): $exception";
	}

}


/*-----------*/
/* Utilities */
/*-----------*/


/* This function returns the current Auto-Increment value from the given table. */
function getCurrentAutoIncValue($tableName){

	try {

		$conn = getConnection(); //Creates connection.
		$sqlstmt = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'BUILDERS_ASSOCIATION' AND TABLE_NAME = '$tableName';";

		$results = executeQuery($conn, $sqlstmt);
		$conn = NULL; //Closes connection.

		return $results[0]['AUTO_INCREMENT']; //Returns auto_increment value of 1st row.

	} catch (PDOException $exception) {
		echo "Exception Thrown (candidate-listings.php/getCurrentAutoIncValue): $exception";
	}

}

echo getCurrentAutoIncValue();

?>
