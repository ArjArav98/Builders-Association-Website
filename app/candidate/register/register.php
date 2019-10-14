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

if(!empty($_FILES['resume'])) //This gets the data from the 'choose file' field.
{
  $path = "resumes/";
  $path = $path . getCurrentAutoIncValue();
  if(move_uploaded_file($_FILES['resume']['tmp_name'], $path)){ }
  else{
      echo "There was an error uploading the file, please try again!";
  }
}

header('Location: index.html', true, 303);
die();

?>
