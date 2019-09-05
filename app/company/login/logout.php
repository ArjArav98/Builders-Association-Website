<?php

/**********************/
/* COMPANY-LOGOUT.PHP */
/**********************/

/* This file deals with destroying the session variables once the user has logged out. */

session_start();
session_destroy();

/* We now redirect to the index.html page of the LOGIN module. */
header('Location: index.html', true, 303);
die();

?>
