<?php
	include('config.php');
	include('session.php');

	$myemail = $_SESSION['login_email'];
	$mytype = $_SESSION['login_type'];
	$sql = "select * from mydb.tutor where email = '$myemail'";
	$result = mysqli_query($db,$sql);
	$count = mysqli_num_rows($result);

	if($count != 1) {
		header("Location: browse.php");
	}
?>
<html>
<head>
	<title>getCarried</title>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style/nav.css">
	<link rel="stylesheet" type="text/css" href="style/modal.css">
	<link rel="stylesheet" type="text/css" href="style/convention.css">
</head>
<body>
	<ul class="nav">
		<li class="logo"><a class="innerlogo" href="browse.php">getCarried</a></li>
		<li><a href="logout.php" class="hov" onclick="" style="cursor: pointer; display: block;" id="navlogout">LOGOUT</a></li>
		<li><a class="hov" onclick="document.getElementById('id01').style.display='block';" style="cursor: pointer; display: none;" id="blogin">LOGIN</a></li>
		<li><a href="manage.php" class="hov active" id="navmanage">MANAGE</a></li>
		<li><a href="browse.php" class="hov" id="navbrowse">BROWSE</a></li>
	</ul>

	<div style="margin-top: 70px; overflow: auto; height: calc(100vh - 70px); line-height: 0px;">
		<p>ffs FUCK</p>
	</div>

	<script type="text/javascript"></script>
</body>
</html>