<?php

/*****************************/
/* ADMIN-COMPANIES-INDEX.PHP */
/*****************************/

/* This file loads the list of existing companies on the page. */

/* We start the session and include the necessary libraries. */
session_start();
require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/company-listings.php';
require '../../../src/login.php';

/* We check if the user is logged in or not. If not, we redirect the user to the login page. */
if(isNotLoggedIn()) {
	redirectToLogin();
}

/* We get the list of companies which have been created by the admin which are currently in the database. */
$companies = getCompanies(NULL,NULL,NULL);

/* We generate the HTML string for the list of companies. */
$iter = 0;
$noOfCompanies = sizeof($companies[0]);
$html = "";

while($iter < $noOfCompanies) {
	$html .= "<div class='company'>
			<p>
				<span class='cell-value alternative-cl'>".$companies[0][$iter]."</span><span 
				class='cell-value cell-value-bg-bg'>".$companies[1][$iter]."</span><span 
				class='cell-value cell-value-bg alternative-cl'>".$companies[2][$iter]."</span><span 
				class='cell-value cell-value-bg'>".$companies[3][$iter]."</span>
			</p><form 
			method='post' class='company-form' action='delete-company.php'>
				<input type='hidden' name='companyId' value='".$companies[0][$iter]."'>
				<button type='submit' class='red-bg'>Delete Company</button>
			</form><a href='response.php?company=".$companies[0][$iter]."' class='company-form' target='_blank'>
				<input type='hidden' name='companyId' value='".$companies[0][$iter]."'>
				<button type='submit' class='black-bg'>Generate E-Mail</button>
			</a>
		</div>";
	
	$iter += 1;
}

/* We concatenate the headers of the columns to the generated HTML string. */
if($noOfCompanies > 0) {
	$htmlHeaders = "<div class='company'><p>
				<span class='cell-value orange-bg'>COMPANY ID</span><span 
				class='cell-value cell-value-bg-bg orange-bg'>COMPANY NAME</span><span
				class='cell-value cell-value-bg orange-bg'>USERNAME</span><span
				class='cell-value cell-value-bg orange-bg'>PASSWORD</span>
			</p><span 
			class='cell-value form-header orange-bg'>ACCOUNT ACTIONS</span>
		</div>";
	
	$html = $htmlHeaders.$html;
}

/*******/
/* END */
/*******/

?>
<!DOCTYPE html>

	<head>
		<title>Admin - Manage Companies | Builders Association</title>
		<meta charset="UTF-8">
		<meta name="description" content="Web Application for Placements for the Builders Association!">
		<meta name="keywords" content="web,application,placements,civil,builders,arjun,aravind,developer">
		<meta name="author" content="Arjun Aravind">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="static/css/index.css" rel="stylesheet">
	</head>

	<body>
	
		<!-- This page contains options for adding usernames and password for companies. -->

		<nav>
			<a href="../home/index.php">Unplaced Candidates</a><a
			href="../placed/index.php">Placed Candidates</a><a
			href="">Manage Companies</a><a
			href="../history/index.php?page=0">History</a><a
			href="../login/logout.php">Logout</a>
		</nav>

		<!-- The options for filtering present as a form. -->
		<form method="post" class="manage-company-form" action="add-company.php">
			<h2>Add Companies</h2>
			<input type="text" name="name" placeholder="Company Name">
			<input type="text" name="username" placeholder="Username">
			<input type="text" name="password" placeholder="Password">
			<button type="submit">Add</button>
		</form>

		<!-- The list of candidates will be displayed here. -->
		<div class="companies-list">
			<?php echo $html; ?>
		</div>

	</body>

</html>
