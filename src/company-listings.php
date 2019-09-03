<?php

/************************/
/* COMPANY-LISTINGS.PHP */
/************************/

/* This file contains functions necessary for manipulating, inserting and deleting records in the company listings. */

/* We import the necessary php libraries. */
require 'sql-connections.php';
require 'sql-functions.php';
require 'data-validation.php';

/*-----------*/
/* INSERTION */
/*-----------*/

/* This function inserts given candidate info into 'Unplaced Candidates' table. */
function insertCompany($name,$username,$password){

	/* We must first validate the information. */
	/* If not valid, we return false. */

	if(usernameIsValid($username) == false) {
		return false;
	}
	else if(passwordIsValid($password) == false) {
		return false;
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
		return false;
	}

	/* If successful, we return true. */
	return true;

}

echo insertCompany('arjun','arjun1001','arjun1001');

?>
