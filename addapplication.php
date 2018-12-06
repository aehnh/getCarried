<?php
	include('config.php');
	include('session.php');
	$myemail = $_SESSION['login_email'];
	$mytuteesql = "SELECT * from mydb.tutee where email = '$myemail'";
	$mytutee = mysqli_query($db, $mytuteesql);
	$row0 = mysqli_fetch_array($mytutee,MYSQLI_ASSOC);
	$tuteeID = $row0['TuteeID'];
	$postid = $_POST['pid'];
	$sql1 = "SELECT * from mydb.post where PID = '$postid'";
	$result1 = mysqli_query($db, $sql1);
	$row = mysqli_fetch_array($result1,MYSQLI_ASSOC);
	$tutor = $row['TutorID'];
	//$tutor = mysqli_query($db, $tutorsql);
	$msg = $_POST['Message'];
	#$tuteeID = $_POST['tuteeID'];
  	$sql = "INSERT INTO `mydb`.`application`
(`PostID`,
`TuteeID`,
`Message`,
`TutorID`)
VALUES
('$postid',
'$tuteeID',
'$msg',
'$tutor')";
$result = mysqli_query($db,$sql);
header("Location: browse.php");
?>