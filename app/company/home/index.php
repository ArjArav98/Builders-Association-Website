<?php

/**************************/
/* COMPANY-HOME-INDEX.PHP */
/**************************/

/* This file loads the necessary information for the 'COMPANY-HOME' page. */

/* We start the SESSION and include the necessary libraries. */
session_start();
require '../../../src/candidate-listings.php';

/* We get the required list of candidates from the database using the search options. */
$results = getCandidate(NULL, NULL, NULL, NULL, $_SESSION['COMPANY_ID'], 0, 0, 1);

$iterator = 0;
$length = sizeof($results[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {

	$HTML .= "<div class='candidate'>";
	$HTML .= "<a href='../../candidate/details/index.php?q=".$results[0][$iterator]."&placed=0&referred=".$_SESSION['COMPANY_ID']."'><span class='cell-value cell-value-bg alternative-cl'>".$results[1][$iterator]."</span><span class='cell-value'>".$results[2][$iterator]."</span><span class='cell-value alternative-cl'>".$results[3][$iterator]."</span><span class='cell-value cell-value-bg'>".$results[4][$iterator]."</span></a>";
	$HTML .= "<form method='post' action='place-candidate.php' class='candidate-form place'><input type='hidden' name='candidateId' value='".$results[0][$iterator]."'><button type='submit'>Place</button></form><form method='post' action='reject-candidate.php' class='candidate-form reject'><input type='hidden' name='candidateId' value='".$results[0][$iterator]."'><button type='submit'>Reject</button></form>";
	$HTML .= "</div>";

	$iterator += 1;
}

/*******/
/* END */
/*******/

?>

<!DOCTYPE html>

	<head>
		<title>Companies - Home | Builders Association</title>
		<meta name="description" content="Web Application for Placements for the Builders Association!">
		<meta name="keywords" content="web,application,placements,civil,builders,arjun,aravind,developer">
		<meta name="author" content="Arjun Aravind">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="static/css/index1.css" rel="stylesheet">
	</head>

	<body>

		<!-- This page will have a list of referred candidates for the company. -->

		<nav>
			<a href="">Referred Candidates</a><a
			href="../placed/index.php">Placed Candidates</a><a
			href="../login/logout.php">Logout</a>
		</nav>

		<h2>Referred Candidates<br><span>Click on candidate names to view the full profile!</span></h2>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
