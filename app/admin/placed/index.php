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
$results = getCandidate(NULL, $_SESSION["SEARCH_QUALIFICATION"], $_SESSION["SEARCH_EXPERIENCE"], $_SESSION["SEARCH_DISTRICT"], NULL, 1, 0, 1);

$iterator = 0;
$length = sizeof($results[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {
	$HTML .= "<div class='candidate'>";
	$HTML .= "<a href='../../candidate/details/index.php?q=".$results[0][$iterator]."&placed=1&referred=0'><span class='cell-value cell-value-bg alternative-cl'>".$results[1][$iterator]."</span><span class='cell-value'>".$results[3][$iterator]."</span><span class='cell-value cell-value-bg-bg alternative-cl'>".$results[4][$iterator]."</span><span class='cell-value'>".$results[2][$iterator]."</span></a>";
	$HTML .= "</div>";

	$iterator += 1;
}

/*******/
/* END */
/*******/

?>

<!DOCTYPE html>

	<head>
		<title>Admin - Placed Candidates | Builders Association</title>
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
			href="../login/logout.php">Logout</a>
		</nav>

		<!-- The options for filtering present as a form. -->
		<form method="get" action="admin-filter.php" class="search-form">
			<h2><i class="material-icons">search</i> Filter Candidates</h2>
			<select name="qualification">
				<option value="">Qualification</option>
				<option value="DIPLOMA">Diploma</option>
				<option value="BACHELORS">Bachelors</option>
				<option value="SCHOOL">School</option>
			</select>
			<select name="experience">
				<option value="">Experience</option>
				<option value="FRESHER">Fresher</option>
				<option value="0-5 YEARS">0-5 Years</option>
				<option value="5+ YEARS">5+ Years</option>
			</select>
			<select name="district">
				<option value="">Select District/Locality</option>
				<option value="ARIYALUR">Ariyalur</option>
				<option value="CHENGALPATTU">Chengalpattu</option>
				<option value="CHENNAI">Chennai</option>
				<option value="COIMBATORE">Coimbatore</option>
				<option value="CUDDALORE">Cuddalore</option>
				<option value="DHARMAPURI">Dharmapuri</option>
				<option value="DINDIGUL">Dindigul</option>
				<option value="ERODE">Erode</option>
				<option value="KALLAKURICHI">Kallakurichi</option>
				<option value="KANCHIPURAM">Kanchipuram</option>
				<option value="KANNIYAKUMARI">Kanniyakumari</option>
				<option value="KARUR">Karur</option>
				<option value="KRISHNAGIRI">Krishnagiri</option>
				<option value="MADURAI">Madurai</option>
				<option value="NAGAPPATINAM">Nagapattinam</option>
				<option value="NAMAKKAL">Namakkal</option>
				<option value="NILGIRIS">Nilgiris</option>
				<option value="PERAMBALUR">Perambalur</option>
				<option value="PUDUKOTTAI">Pudukottai</option>
				<option value="RAMANATHAPURAM">Ramanathapuram</option>
				<option value="RANIPET">Ranipet</option>
				<option value="SALEM">Salem</option>
				<option value="SIVAGANGA">Sivaganga</option>
				<option value="TENKASI">Tenkasi</option>
				<option value="THANJAVUR">Thanjavur</option>
				<option value="THENI">Theni</option>
				<option value="THOOTHUKUDI">Thoothukudi</option>
				<option value="TIRUCHIRAPALLI">Tiruchirapalli</option>
				<option value="TIRUNELVELI">Tirunelveli</option>
				<option value="TIRUPATHUR">Tirupathur</option>
				<option value="TIRUPPUR">Tiruppur</option>
				<option value="TIRUVALLUR">Tiruvallur</option>
				<option value="TIRUVANNAMALAI">Tiruvannamalai</option>
				<option value="TIRUVARUR">Tiruvarur</option>
				<option value="VELLORE">Vellore</option>
				<option value="VILLUPURAM">Villupuram</option>
				<option value="VIRUDHUNAGAR">Virudhunagar</option>
			</select><br>
			<button type="submit">Search!</button>
		</form>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
