<?php
	include('config.php');
	include('session.php');
	$course = $_POST['postid'];
	$myemail = $_SESSION['login_email'];
	$mytutorsql = "SELECT * from mydb.tutor where email = '$myemail'";
	$mytutor = mysqli_query($db, $mytutorsql);
	$row0 = mysqli_fetch_array($mytutor,MYSQLI_ASSOC);
	$tutorID = $row0['TutorID'];
  	$sql = "DELETE FROM `mydb`.`post`
WHERE PID = '$course'";
$result = mysqli_query($db,$sql);
header("Location: tutor.php");
?>