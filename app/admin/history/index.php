<?php

/***************************/
/* ADMIN-HISTORY-INDEX.PHP */
/***************************/

/* This file loads the contents of the history page. */

/* We get the necessary libraries and start the session. */
session_start();
require '../../../src/logger.php';
require '../../../src/login.php';

/* We check if the user is logged in or not. If not, we redirect the user to the login page. */
if(isNotLoggedIn()) {
	redirectToLogin();
}

/* We get the necessary data from the page. */
$pageNum = $_REQUEST['page'];

/* We load the contents of the page. */
if ($_SESSION["HISTORY_SEARCH"] == NULL) {
	$string = getLoggerContents($pageNum);
}
else {
	$string = searchHistoryFor($_SESSION["HISTORY_SEARCH"]);
	$_SESSION["HISTORY_SEARCH"] = NULL;
}

/* We initialise the links for the next and previous pages. */
$prevPageNum = ($pageNum == 0)? 0 : $pageNum - 1;
$nextPageNum = $pageNum + 1;

?>
<!DOCTYPE html>

	<head>
		<title>Admin - History | Builders Association</title>
		<meta name="description" content="Web Application for Placements for the Builders Association!">
		<meta name="keywords" content="web,application,placements,civil,builders,arjun,aravind,developer">
		<meta name="author" content="Arjun Aravind">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="static/css/index.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>

	<body>

		<!-- This page contains options for viewing a log of the application. -->
		<nav>
			<a href="../home/index.php">Unplaced Candidates</a><a
			href="../placed/index.php">Placed Candidates</a><a
			href="../companies/index.php">Manage Companies</a><a
			href="">History</a><a
			href="../login/logout.php">Logout</a>
		</nav>

		<!-- The options for searching present as a form. -->
		<form method="get" action="search-history.php" class="search-form">
			<h2>Search History</h2>
			<input type="text" name="searchTerm" placeholder="Enter Search Term">	
			<button type="submit">Search!</button>
		</form>

		<!-- The LOG.TXT is displayed here. -->
		<div class="logger">
			<a href="./index.php?page=<?php echo $prevPageNum; ?>" class="">Previous</a>
			<a href="./index.php?page=<?php echo $nextPageNum; ?>" class="">Next</a>
			<p><?php echo $string; ?></p>
		</div>

	</body>

</html>
