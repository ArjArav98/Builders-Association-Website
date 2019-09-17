<?php

/***************************/
/* ADMIN-HISTORY-INDEX.PHP */
/***************************/

/* This file loads the contents of the history page. */

require '../../../src/logger.php';

$pageNum = $_REQUEST['page'];
$string = getLoggerContents($pageNum);

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

		<div class="logger">
			<a href="./index.php?page=<?php echo $prevPageNum; ?>" class="">Previous</a>
			<a href="./index.php?page=<?php echo $nextPageNum; ?>" class="">Next</a>
			<p><?php echo $string; ?></p>
		</div>

	</body>

</html>
