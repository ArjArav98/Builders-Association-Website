<?php

/*************/
/* INDEX.PHP */
/*************/

/* This file contains code required to load the home page for the admins. */

/* We start the session and include necessary libraries. */
session_start();
require '../../src/candidate-listings.php';

/* We get the required list of candidates from the database using the search options. */
/* These search options are present as SESSION variables. */
$results = getCandidate($_SESSION["SEARCH_NAME"], $_SESSION["SEARCH_NUMBER"], $_SESSION["SEARCH_EMAIL"], $_SESSION["SEARCH_QUALIFICATION"], NULL, 0, 1);

$iterator = 0;
$length = sizeof($results[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {
	$HTML .= "<div class='candidate'><p>".$results[1][$iterator].", ".$results[2][$iterator].", ".$results[3][$iterator].", ".$results[4][$iterator]."</p><form method='post' class='candidate-form'><input type='text' name='companyid' placeholder='Company ID'><button type='submit'>Refer</button></form></div>";

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

		<!-- We'll need the filtering options and list of candidates. -->

		<!-- The options for filtering present as a form. -->
		<form method="get" action="admin-filter.php">
			<h2>Search Options</h2>
			<input type="text" name="name" placeholder="Name">
			<input type="number" name="number" placeholder="Phone Number">
			<input type="email" name="email" placeholder="Email">
			<select name="qualification">
				<option value="NULL">Qualification</option>
				<option value="DIPLOMA">Diploma</option>
				<option value="BACHELORS">Bachelors</option>
				<option value="SCHOOL">School</option>
			</select>
			<button type="submit">Search!</button>
		</form>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
