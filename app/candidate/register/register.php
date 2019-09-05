<?php

require '../../../src/candidate-listings.php';

$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$qualification = $_POST['qualification'];
$experience = $_POST['experience'];
$district = $_POST['district'];

insertCandidate($name, $number, $email, $qualification, $experience, $district);

header('Location: index.html', true, 303);
die();

?>
