<?php

require '../../src/candidate-listings.php';

$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$qualification = $_POST['qualification']; 

insertCandidate($name, $number, $email, $qualification);

header('Location: index.html', true, 303);
die();

?>
