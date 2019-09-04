<?php

/**************/
/* LOGOUT.PHP */
/**************/

/* This file destroys the session variables and unsets them. */
session_start();
session_destroy();

/* We then redirect to the index.html of the ADMIN-LOGIN module. */
header('Location: index.html', true, 303);
die();

?>
