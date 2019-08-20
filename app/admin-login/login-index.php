<?php

require '../../src/login.php';

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if(login($username,$password,false) == true) {
	echo "<script>window.location.href='../admin-home/index.html';</script>";
}
else {
	echo "<script>window.location.href='index.html';</script>";
}

?>
