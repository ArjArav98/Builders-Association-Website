<?php

/****************************/
/* COMPANY-PLACED-INDEX.PHP */
/****************************/

/* This file loads the necessary information for the 'COMPANY-HOME' page. */

/* We start the SESSION and include the necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';
require '../../../src/login.php';

/* We check if the user is logged in, otherwise we redirect to the home page. */
if(isNotLoggedIn()) {
	redirectToLogin();
}

/* We get the required list of candidates from the database using the search options. */
$results = getCandidate(NULL, NULL, NULL, NULL, $_SESSION['COMPANY_ID'], 1, 0, 1);

$iterator = 0;
$length = sizeof($results[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {

	$HTML .= "<div class='candidate'>
			<a href='../../candidate/details/index.php?q=".$results[0][$iterator]."&placed=1&referred=0'>
				<span class='cell-value cell-value-bg alternative-cl'>".$results[1][$iterator]."</span><span
				class='cell-value'>".$results[2][$iterator]."</span><span 
				class='cell-value alternative-cl'>".$results[3][$iterator]."</span><span 
				class='cell-value cell-value-bg'>".$results[4][$iterator]."</span>
			</a>
		</div>";

	$iterator += 1;
}

/* This block concatenates the headers of the columns to the HTML string generated. */
if($length > 0) {

	$htmlHeaders = "<div class='candidate'>
				<p>
					<span class='cell-value cell-value-bg orange-bg'>NAME</span><span
					class='cell-value orange-bg'>QUAL.</span><span 
					class='cell-value orange-bg'>EXP.</span><span 
					class='cell-value cell-value-bg orange-bg'>DISTRICT</span>
				</p>
			</div>";

	$HTML  = $htmlHeaders.$HTML;
}

/*******/
/* END */
/*******/

?>

<!DOCTYPE html>

	<head>
		<title>Companies - Placed Candidates | Builders Association</title>
		<meta name="description" content="Web Application for Placements for the Builders Association!">
		<meta name="keywords" content="web,application,placements,civil,builders,arjun,aravind,developer">
		<meta name="author" content="Arjun Aravind">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="static/css/index1.css" rel="stylesheet">
	</head>

	<body>

		<!-- This page will have a list of referred candidates for the company. -->

		<nav>
			<a href="../home/index.php">Referred Candidates</a><a
			href="">Placed Candidates</a><a
			href="../login/logout.php">Logout</a>
		</nav>

		<h2>Candidates Placed<br><span>Click on candidate names to view the full profile!</span></h2>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
