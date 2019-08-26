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
		<style>
			body, html {
				margin: 0;
				padding: 0;

				font-family: "Verdana", sans-serif;
				color: black;
			}

			form {
				display: block;
				width: 100%;

				text-align: center;
				background-color: white;
			}

			input {
				width: 15%;

				margin: 0% 1%;
				padding: 0.5%;

				font-size: 105%;
			}

			select {
				width: 15%;
			}

			h2 {
				display: block;
				margin: 3% 0% 1.5% 0%;
				width: 100%;
				
				text-align: center;
			}

			button {
				width: 16.3%;

				margin: 0% 1%;
				padding: 0.5%;

				font-size: 105%;
			}

			.candidate-list {
				display: block;
				width: 100%;

				margin: 5% 0%;
			}

			.candidate {
				display: block;
				width: 60%;

				margin: 0 auto;

				text-align: center;
				border: 1px solid black;
			}

			.candidate p {
				display: inline-block;
				width: 100%;

				margin: 0.5% 0%;
				vertical-align: middle;
			}

			.candidate-form input {
				margin: 1% 0%;
			}

			.candidate-form button {
				padding: 0.7%;		
			}
		</style>
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
