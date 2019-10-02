<?php

/*************/
/* INDEX.PHP */
/*************/

/* This file contains code required to load the home page for the admins. */

/* We start the session and include necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';
require '../../../src/login.php';
require '../../../src/feedback.php';

/* We check if the user is logged in or not. If not, we redirect the user to the login page. */
if(isNotLoggedIn()) {
	redirectToLogin();
}

/* We get the required feedback. */
$feedbacks = getFeedback();

$iterator = 0;
$length = sizeof($feedbacks[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {
	$HTML .= "<div class='candidate'>
			<a href='#'><span
				class='cell-value cell-value-bg-bg alternative-cl'>".$feedbacks[1][$iterator]."</span>
			</a>
		</div>";

	$iterator += 1;
}

/* We concatenate the headers of the columns to the generated HTML string. */
if($length > 0) {
	$HTMLHeaders = "<div class='candidate'>
			<p><span
				class='cell-value cell-value-bg-bg orange-bg'>CANDIDATE FEEDBACK</span>
			</p>
		</div>";

	$HTML  = $HTMLHeaders.$HTML;
}

/*******/
/* END */
/*******/

?>

<!DOCTYPE html>

	<head>
		<title>Admin - Feedback Portal | Builders Association</title>
		<meta name="description" content="Web Application for Placements for the Builders Association!">
		<meta name="keywords" content="web,application,placements,civil,builders,arjun,aravind,developer">
		<meta name="author" content="Arjun Aravind">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="static/css/index1.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>

	<body>
	
		<!-- This page displays all submitted feedback by students. -->
		<nav>
			<a href="../home/index.php">Unplaced Candidates</a><a
			href="../placed/index.php">Placed Candidates</a><a
			href="../companies/index.php">Manage Companies</a><a
			href="">Feedback</a><a
			href="../history/index.php?page=0">History</a><a
			href="../login/logout.php">Logout</a>
		</nav>

		<h2 class="unplaced-h2">Candidate Feedback<br><span>Click on the feedback to know more!</span></h2>

		<!-- The feedbacks will all be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
