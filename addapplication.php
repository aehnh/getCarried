<?php
	include('config.php');
	include('session.php');
	$postid = $_POST['pid'];
	#$sql = "SELECT * from mydb.post where PID = '$postid'";
	#$result = mysqli_query($db, $sql);
	#$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	#$tutor = $row['TutorID'];
	//$tutor = mysqli_query($db, $tutorsql);
	$msg = $_POST['Message'];
  	$sql = "INSERT INTO `mydb`.`application`
(`PostID`,
`TuteeID`,
`Message`,
`TutorID`)
VALUES
('$postid',
10,
'$msg',
3)";
$result = mysqli_query($db,$sql);
header("Location: tutee.php");
?>