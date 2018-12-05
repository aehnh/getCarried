<?php
	include('config.php');
	include('session.php');
	$course = $_POST['course'];
	$description = $_POST['description'];
	$show = $_POST['$myemail']
  	$sql = "INSERT INTO `mydb`.`post`
(`course_name`,
`description`,
`tutor_email`)
VALUES
('$course',
'$description',
'$show')";
$result = mysqli_query($db,$sql);
header("Location: tutor.php");
?>