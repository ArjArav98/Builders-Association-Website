<?php

/*************/
/* INDEX.PHP */
/*************/

/* This file loads the necessary information for the 'COMPANY-HOME' page. */

/* We start the SESSION and include the necessary libraries. */
session_start();
require '../../../src/candidate-listings.php';

/* We get the required list of candidates from the database using the search options. */
$results = getCandidate(NULL, NULL, NULL, NULL, $_SESSION['COMPANY_ID'], 0, 1);

$iterator = 0;
$length = sizeof($results[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {

	$HTML .= "<div class='candidate'>";
	$HTML .= "<p><span class='cell-value cell-value-bg'>".$results[1][$iterator]."</span><span class='cell-value'>".$results[2][$iterator]."</span><span class='cell-value cell-value-bg'>".$results[3][$iterator]."</span><span class='cell-value'>".$results[4][$iterator]."</span>";
	$HTML .= "<form method='get' action='place-candidate.php' class='candidate-form'><input type='hidden' name='candidateId' value='".$results[0][$iterator]."'><button type='submit'>Place</button></form><form method='get' action='reject-candidate.php' class='candidate-form'><input type='hidden' name='candidateId' value='".$results[0][$iterator]."'><button type='submit'>Reject</button></form>";
	$HTML .= "</p></div>";

	$iterator += 1;
}

/*******/
/* END */
/*******/

?>

<!DOCTYPE html>

	<head>
		<title>Companies - Home | Builders Association</title>
		<link href="static/css/index1.css" rel="stylesheet">
	</head>

	<body>

		<nav>
			<a href="">Referred Candidates List</a>
			<a href="../login/index.html">Logout</a>
		</nav>

		<h2>Referred Candidates</h2>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
