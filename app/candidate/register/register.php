<?php

require '../../../src/sql-connections.php';
require '../../../src/sql-functions.php';
require '../../../src/data-validation.php';
require '../../../src/candidate-listings.php';
require '../../../src/mail.php';

$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$qualification = $_POST['qualification'];
$experience = $_POST['experience'];
$district = $_POST['district'];

insertCandidate($name, $number, $email, $qualification, $experience, $district);
sendInfoEmailToCandidate($email);

header('Location: index.html', true, 303);
die();

?>
