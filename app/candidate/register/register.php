<?php

/****************/
/* REGISTER.PHP */
/****************/

/* This file takes data from the candidate/register module and inserts into the table. */

/* We first include the necessary libraries. */
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';
require '../../../src/mail.php';

/* This takes the data from the form. */
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$qualification = $_POST['qualification'];
$experience = $_POST['experience'];
$district = $_POST['district'];

/* We move the chosen resume to the resumes/ folder. */
$path = "";
if(!empty($_FILES['resume'])) {
	$path = "resumes/";
	$extension = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
	$path = $path.getCurrentAutoIncValue().".".$extension;
	
	if(move_uploaded_file($_FILES['resume']['tmp_name'], $path)){ }
	else { }
}

/* We insert the data into the table and send the email to the candidate's email. */
insertCandidate($name, $number, $email, $qualification, $experience, $district, $path);
sendInfoEmailToCandidate($email);

/* We then redirect to the index.html file. */
header('Location: index.html', true, 303);
die();

?>
