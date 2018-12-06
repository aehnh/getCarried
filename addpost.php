<?php
	include('config.php');
	include('session.php');
	$course = $_POST['course'];
	$description = $_POST['description'];

	$myemail = $_SESSION['login_email'];
	$mytutorsql = "SELECT * from mydb.tutor where email = '$myemail'";
	$mytutor = mysqli_query($db, $mytutorsql);
	$row0 = mysqli_fetch_array($mytutor,MYSQLI_ASSOC);
	$tutorID = $row0['TutorID'];

  	$sql = "INSERT INTO `mydb`.`post`
(`TutorID`,
`Subject`,
`Description`)
VALUES
('$tutorID',
'$course',
'$description')";
$result = mysqli_query($db,$sql);
header("Location: manage.php");
?>