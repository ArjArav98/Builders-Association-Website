<?php

/*****************************/
/* ADMIN-COMPANIES-INDEX.PHP */
/*****************************/

/* This file loads the list of existing companies on the page. */

/* We start the session and include the necessary libraries. */
session_start();
require '../../../src/company-listings.php';

/* We get the list of companies which have been created by the admin which are currently in the database. */
$companies = getCompanies();

/* We generate the HTML string for the list of companies. */
$iter = 0;
$noOfCompanies = sizeof($companies[0]);
$html = "";

while($iter < $noOfCompanies) {
	$html .= "<div class='company'>
			<p>
				<span class='cell-value alternative-cl'>".$companies[0][$iter]."</span>
				<span class='cell-value cell-value-bg-bg'>".$companies[1][$iter]."</span>
				<span class='cell-value cell-value-bg alternative-cl'>".$companies[2][$iter]."</span>
				<span class='cell-value cell-value-bg'>".$companies[3][$iter]."</span>
			</p>
			<form method='post' class='company-form' action='delete-company.php'>
				<input type='hidden' name='companyId' value='".$companies[0][$iter]."'>
				<button type='submit'>Delete</button>
			</form>
		</div>";
	
	$iter += 1;
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
			href="">History</a><a
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
