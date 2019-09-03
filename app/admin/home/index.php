<?php

/*************/
/* INDEX.PHP */
/*************/

/* This file contains code required to load the home page for the admins. */

/* We start the session and include necessary libraries. */
session_start();
require '../../../src/candidate-listings.php';

/* We get the required list of candidates from the database using the search options. */
/* These search options are present as SESSION variables. */
$results = getCandidate($_SESSION["SEARCH_NAME"], $_SESSION["SEARCH_NUMBER"], $_SESSION["SEARCH_EMAIL"], $_SESSION["SEARCH_QUALIFICATION"], NULL, 0, 1);

$iterator = 0;
$length = sizeof($results[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {
	$HTML .= "<div class='candidate'>";
	$HTML .= "<p><span class='cell-value cell-value-bg alternative-cl'>".$results[1][$iterator]."</span><span class='cell-value'>5+ years</span><span class='cell-value cell-value-bg-bg alternative-cl'>UT OF ANDAMAN AND NICOBAR ISLANDS</span><span class='cell-value'>".$results[4][$iterator]."</span></p>";
	$HTML .= "<form method='get' action='refer-company.php' class='candidate-form refer-form'><input type='text' name='companyid' placeholder='Company ID'><input type='hidden' name='candidateid' value='".$results[0][$iterator]."'><button type='submit'>Refer</button></form>";
	$HTML .= "</div>";

	$iterator += 1;
}

/*******/
/* END */
/*******/

?>

<!DOCTYPE html>

	<head>
		<title>Admin - Home | Builders Association</title>
		<link href="static/css/index1.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>

	<body>
	
		<!-- This page contains options for displaying and searching for candidates. -->
		<!-- This page also contains an option to log out and display comapnies. -->

		<nav>
			<a href="../companies/index.php">Manage Companies</a><a
			href="">Candidates List</a><a
			href="../login/index.html">Logout</a>
		</nav>

		<!-- The options for filtering present as a form. -->
		<form method="get" action="admin-filter.php" class="search-form">
			<h2><i class="material-icons">search</i> Filter Candidates</h2>
			<input type="text" name="name" placeholder="Name">
			<input type="number" name="number" placeholder="Phone Number"><br>
			<input type="email" name="email" placeholder="Email">
			<select name="qualification">
				<option value="NULL">Qualification</option>
				<option value="DIPLOMA">Diploma</option>
				<option value="BACHELORS">Bachelors</option>
				<option value="SCHOOL">School</option>
			</select><br>
			<button type="submit">Search!</button>
		</form>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
