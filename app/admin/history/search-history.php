<?php

/**********************/
/* SEARCH-HISTORY.PHP */
/**********************/

/* This file takes the search term and adds it to the SESSION variables. */

/* We start the session. */
session_start();

/* We get the necessary search data. */
$_SESSION["HISTORY_SEARCH"] = $_REQUEST["searchTerm"];

/* We then redirect to the HISTORY-INDEX.PHP file. */
header('Location: index.php?page=0', true, 303);
die();

?>
