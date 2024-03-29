<?php

/*******************************/
/* CANDIDATE-DETAILS-INDEX.PHP */
/*******************************/

/* This file gives the full details of the specified candidate. */

/* We include the necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';
require '../../../src/login.php';

/* We check if the user is logged in. If not, we redirect the user to the company login page. */
if(isNotLoggedIn()) {
	redirectToLoginFromCandidate();
}

/* We get the ID of the candidate through the URL. */
$candidateId = $_REQUEST['q'];
$placed = $_REQUEST['placed'];
$referred = $_REQUEST['referred'];

$referred = ($referred == 0)? NULL : $referred; /* If $referred is 0, then make it NULL. */

/* We now get the information of the candidate. */
$result = getCandidate($candidateId, NULL, NULL, NULL, $referred, $placed, 1, 1);

/*******/
/* END */
/*******/

?>
<!DOCTYPE html>

	<head>
		<title><?php echo $result[1][0]; ?> | Builders Association</title>
		<meta name="description" content="Web Application for Placements for the Builders Association!">
		<meta name="keywords" content="web,application,placements,civil,builders,arjun,aravind,developer">
		<meta name="author" content="Arjun Aravind">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="static/css/index.css" rel="stylesheet">
	</head>

	<body>

		<h2>Candidate Details</h2>

		<p class="alternative-p"><span>Name:</span> <?php echo $result[1][0]; ?></p>
		<p><span>Number:</span> <?php echo $result[2][0]; ?></p>
		<p class="alternative-p"><span>Email:</span> <?php echo $result[3][0]; ?></p>
		<p><span>Experience:</span> <?php echo $result[5][0]; ?></p>
		<p class="alternative-p"><span>Qualification:</span> <?php echo $result[4][0]; ?></p>
		<p><span>District:</span> <?php echo $result[6][0] ?></p>
		<a href="<?php echo "../register/".$result[7][0];?>">Download Resume</a>

	</body>

</html>
