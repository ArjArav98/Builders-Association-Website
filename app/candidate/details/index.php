<?php

/*******************************/
/* CANDIDATE-DETAILS-INDEX.PHP */
/*******************************/

/* This file gives the full details of the specified candidate. */

/* We include the necessary libraries. */
require '../../../src/candidate-listings.php';

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
		<style>

			body, html {
				margin: 0;
				padding: 0;

				font-family: "Verdana", sans-serif;
			}

			h2 {
				margin: 4%;
				text-align: center;
				color: #2196f3;
			}

			p {
				width: 40%;

				margin: 0 auto;
				padding: 1.25%;

				text-align: center;
				font-size: 110%;
				color: #2196f3;
			}

			.alternative-p {
				background-color: #2196f3;
				color: white;
			}

			span {
				font-weight: 600;
			}

			a {
				display: block;
				width: 20%;

				margin: 2% auto;
				padding: 1.25%;

				border: 2px solid #2196f3;

				text-decoration: none;
				text-align: center;
				color: white;
				background-color: #2196f3;
				font-size: 110%;
				font-weight: 600;
			}

		</style>
	</head>

	<body>

		<h2>Candidate Details</h2>

		<p class="alternative-p"><span>Name:</span> <?php echo $result[1][0]; ?></p>
		<p><span>Number:</span> <?php echo $result[2][0]; ?></p>
		<p class="alternative-p"><span>Email:</span> <?php echo $result[3][0]; ?></p>
		<p><span>Experience:</span> <?php echo $result[5][0]; ?></p>
		<p class="alternative-p"><span>Qualification:</span> <?php echo $result[4][0]; ?></p>
		<p><span>District:</span> <?php echo $result[6][0] ?></p>
		<a href="#">Download Resume</a>

	</body>

</html>
