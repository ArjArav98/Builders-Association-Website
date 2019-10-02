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
			<p><span
				class='cell-value alternative-cl'>".$feedbacks[0][$iterator]."</span><span 
				class='cell-value cell-value-bg-bg'>".$feedbacks[1][$iterator]."</span>
			</p>
		</div>";

	$iterator += 1;
}

/* We concatenate the headers of the columns to the generated HTML string. */
if($length > 0) {
	$HTMLHeaders = "<div class='candidate'>
			<p><span
				class='cell-value orange-bg'>CANDIDATE ID</span><span 
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
		<title>Admin - Placed Candidates | Builders Association</title>
		<meta name="description" content="Web Application for Placements for the Builders Association!">
		<meta name="keywords" content="web,application,placements,civil,builders,arjun,aravind,developer">
		<meta name="author" content="Arjun Aravind">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="static/css/index1.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>

	<body>
	
		<!-- This page contains options for displaying and searching for candidates. -->
		<!-- This page also contains an option to log out and display comapnies. -->

		<nav>
			<a href="../home/index.php">Unplaced Candidates</a><a
			href="">Placed Candidates</a><a
			href="../companies/index.php">Manage Companies</a><a
			href="../feedback/index.php">Feedback</a><a
			href="../history/index.php?page=0">History</a><a
			href="../login/logout.php">Logout</a>
		</nav>

		<h2 class="unplaced-h2">Candidate Feedback<br><span>Get candidate details, using the ID provided, in the 'History' page.</span></h2>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
