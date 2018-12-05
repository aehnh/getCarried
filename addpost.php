<?php
	include('config.php');
	include('session.php');
	$course = $_POST['course'];
	$description = $_POST['description'];
	#$myemail = $_SESSION['TutorID'];
  	$sql = "INSERT INTO `mydb`.`post`
(`TutorID`,
`Subject`,
`Description`)
VALUES
(3,
'$course',
'$description')";
$result = mysqli_query($db,$sql);
header("Location: tutor.php");
?>