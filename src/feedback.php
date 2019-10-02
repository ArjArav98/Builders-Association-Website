<?php

/****************/
/* FEEDBACK.PHP */
/****************/

/* This file deals with functions pertaining with the feedback file. */

/* This function inserts the feedback into the database. */
function submitFeedback($candidateId, $message) {
	try {
		$connection = getConnection();
		$sqlstmt = "INSERT INTO FEEDBACK VALUES (ID,?,?);";

		$sql = $connection->prepare($sqlstmt);
		$sql->bindParam(1, $candidateId);
		$sql->bindParam(2, $message);
		$sql->execute();

		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (feedback.php/submitFeedback): $exception";
	}
}

/* This functions gets all the feedback data from the database. */
function getFeedback() {
	try {
		$connection = getConnection(); //Creates connection.

		$sqlstmt = "SELECT CANDIDATEID, MESSAGE FROM FEEDBACK ORDER BY ID DESC;";
		$results = executeQuery($connection, $sqlstmt);
		$connection = NULL; //Closes connection.

		$id = array();
		$message = array();
		
		foreach ($results as $row) {
			array_push($id,$row['CANDIDATEID']);
			array_push($message,$row['MESSAGE']);
		}

		return array($id,$message);
	} catch (PDOException $exception) {
		echo "Exception Thrown (feedback.php/getFeedback): $exception";
	}
}

?>
