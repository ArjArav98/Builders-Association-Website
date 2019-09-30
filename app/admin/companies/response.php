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
require '../../../src/mail.php';

/* We get the necessary data. */
$companyId = $_REQUEST['company'];

/*******/
/* END */
/*******/

?>
<!DOCTYPE html>

	<head>
		<title>Admin - Email Response | Builders Association</title>
		<meta charset="UTF-8">
		<meta name="description" content="Web Application for Placements for the Builders Association!">
		<meta name="keywords" content="web,application,placements,civil,builders,arjun,aravind,developer">
		<meta name="author" content="Arjun Aravind">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="static/css/index.css" rel="stylesheet">
	</head>

	<body>

		<!-- The generated email response will be displayed here. -->
		<div class="companies-list">
			<div class="candidate">
				<p style="width: 70%; margin: 5% auto;">
					<?php echo generateEmailResponse($companyId); ?>			
				</p>
			</div>
			
		</div>

	</body>

</html>
