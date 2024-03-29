<?php

/************************/
/* COMPANY-LISTINGS.PHP */
/************************/

/* This file contains functions necessary for manipulating, inserting and deleting records in the company listings. */

/*-----------*/
/* INSERTION */
/*-----------*/

/* This function inserts a given company and its details into the COMPANIES table. */
function insertCompany($name,$username,$password){

	/* We must first validate the information. */
	/* If not valid, we return false. */

	if(usernameIsValid($username) == false) {
		return;
	}

	/* Once everything is set, we insert into SQL table. */

	try {

		$connection = getConnection();
		$sqlstmt = "INSERT INTO COMPANIES VALUES (ID, ?, ?, ?);";

		$sql = $connection->prepare($sqlstmt);
		$sql->bindParam(1, $name);
		$sql->bindParam(2, $username);
		$sql->bindParam(3, $password);
		$sql->execute();

		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (company-listings.php/insertCompany): $exception";
	}

}

/*-----------*/
/* RETRIEVAL */
/*-----------*/

/* This function retrieves the information about companies from the COMPANIES table. */
function getCompanies($id=NULL,$username=NULL,$password=NULL) {

	$sqlstmt = "SELECT* FROM COMPANIES ";

	$sqlstmt .= ($username == NULL)? "WHERE USERNAME LIKE '%' " : "WHERE USERNAME = '$username' ";
	$sqlstmt .= ($password == NULL)? "" : "AND PASSWORD = '$password' ";
	$sqlstmt .= ($id == NULL)? "" : "AND ID = $id ";

	$sqlstmt .= "ORDER BY NAME ASC;";

	try {

		$connection = getConnection(); //Creates connection.
		$results = executeQuery($connection, $sqlstmt);
		$connection = NULL; //Closes connection.

		$id = array();
		$name = array();
		$username = array();
		$password = array();

		foreach ($results as $row) {
			array_push($id,$row['ID']);
			array_push($name,$row['NAME']);
			array_push($username,$row['USERNAME']);
			array_push($password,$row['PASSWORD']);
		}

		return array($id,$name,$username,$password);

	} catch (PDOException $exception) {
		echo "Exception Thrown (company-listings.php/getCompanies): $exception";
	}

}

/*----------*/
/* DELETION */
/*----------*/

/* This function deletes a company and its details from the COMPANIES table. */
function deleteCompany($companyId) {

	try{

		$connection = getConnection();
		$sqlstmt = "DELETE FROM COMPANIES WHERE ID = $companyId;";
	
		$sql = $connection->prepare($sqlstmt);
		$sql->execute();
		$connection = NULL;

	} catch (PDOException $exception) {
		echo "Exception Thrown (company-listings.php/deleteCompany): $exception";
	}

}

?>
