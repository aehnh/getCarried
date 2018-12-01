<?php
	include('config.php');
	include('session.php');
	$course = $_POST['course'];
	$description = $_POST['description'];
  	$sql = "INSERT INTO `mydb`.`post`
(`course_name`,
`description`,
`tutor_email`)
VALUES
('$course',
'$description',
'$login_session')";
$result = mysqli_query($db,$sql);
header("Location: tutor.php");
?>