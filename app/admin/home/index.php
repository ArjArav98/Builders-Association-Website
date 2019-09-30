<?php

/******************/
/* HOME-INDEX.PHP */
/******************/

/* This file contains code required to load the home page for the admins. */

/* We start the session and include necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';

/* We get the required list of candidates from the database using the search options. */
/* These search options are present as SESSION variables. */
$results = getCandidate(NULL, $_SESSION["SEARCH_QUALIFICATION"], $_SESSION["SEARCH_EXPERIENCE"], $_SESSION["SEARCH_DISTRICT"], NULL, 0, 0, 1);

$iterator = 0;
$length = sizeof($results[0]);
$HTML = "";

/* We iterate over the array and generate a HTML string. */
while($iterator < $length) {
	$HTML .= "<div class='candidate'>
			<a href='../../candidate/details/index.php?q=".$results[0][$iterator]."&placed=0&referred=0'><span
				class='cell-value cell-value-bg alternative-cl'>".$results[1][$iterator]."</span><span 
				class='cell-value'>".$results[3][$iterator]."</span><span 
				class='cell-value cell-value-bg-bg alternative-cl'>".$results[4][$iterator]."</span><span 
				class='cell-value'>".$results[2][$iterator]."</span>
			</a><form 
			method='get' action='refer-company.php' class='candidate-form refer-form'>
				<input type='text' name='companyid' placeholder='Company ID'><input 
				type='hidden' name='candidateid' value='".$results[0][$iterator]."'><button 
				type='submit'>Refer</button>
			</form>
		</div>";

	$iterator += 1;
}

/* We concatenate the headers of the columns to the generated HTML string. */
if($length > 0) {
	$HTMLHeaders = "<div class='candidate'>
				<p>
					<span class='cell-value cell-value-bg orange-bg'>NAME</span><span 
					class='cell-value orange-bg'>EXP.</span><span 
					class='cell-value cell-value-bg-bg orange-bg'>DISTRICT OF RESIDENCE</span><span 
					class='cell-value orange-bg'>QUAL.</span>
				</p><span 
				class='cell-value form-header orange-bg'>COMPANY REFERRAL</span>
			</div>";

	$HTML  = $HTMLHeaders.$HTML;
}

/*******/
/* END */
/*******/

?>

<!DOCTYPE html>

	<head>
		<title>Admin - Home | Builders Association</title>
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
			<a href="">Unplaced Candidates</a><a
			href="../placed/index.php">Placed Candidates</a><a
			href="../companies/index.php">Manage Companies</a><a
			href="../history/index.php?page=0">History</a><a
			href="../login/logout.php">Logout</a>
		</nav>

		<!-- The options for filtering present as a form. -->
		<form method="get" action="admin-filter.php" class="search-form">
			<h2>Filter Candidates</h2>
			<select name="qualification">
				<option value="">Qualification</option>
				<option value="Diploma">Diploma</option>
				<option value="Graduate">Graduate</option>
				<option value="Post-Graduate">Post-Graduate</option>
			</select>
			<select name="experience">
				<option value="">Experience</option>
				<option value="Fresher">Fresher</option>
				<option value="0-5 Years">0-5 Years</option>
				<option value="5+ Years">5+ Years</option>
			</select>
			<select name="district">
				<option value="">Select District/Locality</option>
				<option value="Ariyalur">Ariyalur</option>
				<option value="Chengalpattu">Chengalpattu</option>
				<option value="Chennai">Chennai</option>
				<option value="Coimbatore">Coimbatore</option>
				<option value="Cuddalore">Cuddalore</option>
				<option value="Dharmapuri">Dharmapuri</option>
				<option value="Dindigul">Dindigul</option>
				<option value="Erode">Erode</option>
				<option value="Kallakurichi">Kallakurichi</option>
				<option value="Kanchipuram">Kanchipuram</option>
				<option value="Kanniyakumari">Kanniyakumari</option>
				<option value="Karur">Karur</option>
				<option value="Krishnagiri">Krishnagiri</option>
				<option value="Madurai">Madurai</option>
				<option value="Nagappatinam">Nagapattinam</option>
				<option value="Namakkal">Namakkal</option>
				<option value="Nilgiris">Nilgiris</option>
				<option value="Perambalur">Perambalur</option>
				<option value="Pudukottai">Pudukottai</option>
				<option value="Ramanathapuram">Ramanathapuram</option>
				<option value="Ranipet">Ranipet</option>
				<option value="Salem">Salem</option>
				<option value="Sivaganga">Sivaganga</option>
				<option value="Tenkasi">Tenkasi</option>
				<option value="Thanjavur">Thanjavur</option>
				<option value="Theni">Theni</option>
				<option value="Thoothukudi">Thoothukudi</option>
				<option value="Tiruchirapalli">Tiruchirapalli</option>
				<option value="Tirunelveli">Tirunelveli</option>
				<option value="Tirupathur">Tirupathur</option>
				<option value="Tiruppur">Tiruppur</option>
				<option value="Tiruvallur">Tiruvallur</option>
				<option value="Tiruvannamalai">Tiruvannamalai</option>
				<option value="Tiruvarur">Tiruvarur</option>
				<option value="UT of Andaman and Nicobar Islands">UT of Andaman and Nicobar Islands</option>
				<option value="UT of Puducherry">UT of Puducherry</option>
				<option value="Vellore">Vellore</option>
				<option value="Villupuram">Villupuram</option>
				<option value="Virudhunagar">Virudhunagar</option>
			</select><br>
			<button type="submit">Search!</button>
		</form>

		<h2 class="unplaced-h2">Unplaced Candidates<br><span>Click on candidate names to view the full profile!</span></h2>

		<!-- The list of candidates will be displayed here. -->
		<div class="candidate-list">
			<?php echo $HTML; ?>
		</div>

	</body>

</html>
