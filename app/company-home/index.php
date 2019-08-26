<?php

/*************/
/* INDEX.PHP */
/*************/

/* This file loads the necessary information for the 'COMPANY-HOME' page. */

/* We start the SESSION and include the necessary libraries. */
session_start();
require '../../src/candidate-listings.php';

/* We get the required list of candidates from the database using the search options. */
$results = getCandidate(NULL, NULL, NULL, NULL, NULL, 0, 1);

$iterator = 0;
$length = sizeof($results[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {
	$HTML .= "<div class='candidate'><p>".$results[1][$iterator].", ".$results[2][$iterator].", ".$results[3][$iterator].", ".$results[4][$iterator]."</p><form method='post' class='candidate-form'><button type='submit'>Accept</button></form><form method='post' class='candidate-form'><button type='submit'>Reject</button></form></div>";

	$iterator += 1;
}

/*******/
/* END */
/*******/

?>

<!DOCTYPE html>

	<head>
		<title>Admin - Home | Builders Association</title>
		<link href="static/css/index.css" rel="stylesheet">
	</head>

	<body>

		<h2>Referred Candidates</h2>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
