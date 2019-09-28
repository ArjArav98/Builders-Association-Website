<?php

/* This function inits a connection variable and returns it. */
function getConnection(){
	$server = "localhost";
	$username = system("echo \$BUILDERS_USERNAME");
	$password = system("echo \$BUILDERS_PASSWORD");
	$database = "BUILDERS_ASSOCIATION";
    
	$connection=new PDO("mysql:host=$server;dbname=$database", $username, $password);
	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	return $connection;
}

?>
