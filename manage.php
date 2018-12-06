<?php
	include('config.php');
	include('session.php');

	$myemail = $_SESSION['login_email'];
	$mytype = $_SESSION['login_type'];
	if($mytype == "1") {
		$sql = "select * from mydb.tutor where email = '$myemail'";
		$result = mysqli_query($db,$sql);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$name = $row['name'];
		$tid = $row['TutorID'];
	} else if($mytype == "2") {
		header("Location: browse.php");
	}

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
		<p>ffs FUbitchCK</p>
		<?php 
			$sql = "select count(*) from mydb.post where TutorID = '$tid'";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_array($result);
			echo "<tr>";
			echo "Number of posts:".$row[0]."<br>";
			echo "</tr>";


			$sql = "select * from mydb.post where TutorID = $tid";
			$result = mysqli_query($db,$sql);
			echo "<table><tr><td>PID</td><td>Course</td><td>Description</td></tr>";
			while ($data = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo " <td>".$data['PID']."</td>";
				echo " <td>".$data['Subject']."</td>";
				echo "<td>".$data['Description']." </td>";
				echo "</tr>";
			}
			echo "</table>";

			echo "<form method='POST' action='addpost.php'> <select name='course'>";
			$sql = "select * from mydb.course";
			$result = mysqli_query($db,$sql);
			while ($data = mysqli_fetch_array($result)) {
				$cname = $data['name'];
				echo " <option value='$cname'>".$cname."</option>";
			}
			echo "</select>
			<textarea rows='4' cols='50' name='description'>Description2</textarea>
			<input type = 'submit' value = 'add post'>
			</form>";

			echo "<form method='POST' action='editpost.php'> <select name='postid'>";
			$sql = "select * from mydb.post where TutorID = $tid";
			$result = mysqli_query($db,$sql);
			while ($data = mysqli_fetch_array($result)){
			$cname = $data['PID'];
			echo " <option value='$cname'>".$cname."</option>";
			}
			echo "</select>
			<textarea rows='4' cols='50' name='description'>Description</textarea>
			<input type = 'submit' value = 'edit post'>
			</form>";

			echo "<form method='POST' action='deletepost.php'> <select name='postid'>";
			$sql = "select * from mydb.post where TutorID = $tid";
			$result = mysqli_query($db,$sql);
			while ($data = mysqli_fetch_array($result)){
			$cname = $data['PID'];
			echo " <option value='$cname'>".$cname."</option>";
			}
			echo "</select>
			<input type = 'submit' value = 'delete post'>
			</form>";

			$sql = "select * from mydb.application where PostID in (select PID from mydb.post where post.TutorID = '$tid')";
			$result = mysqli_query($db,$sql);
			echo mysqli_error($db);

			echo "<table><tr><td>AppID</td><td>PostID</td><td>TuteeID</td><td>message</td></tr>";
			while ($data = mysqli_fetch_array($result)){
			echo "<tr>";
			echo " <td>".$data['AppID']."</td>";
			echo "<td>".$data['PostID']." </td>";
			echo " <td>".$data['TuteeID']."</td>";
			echo " <td>".$data['Message']."</td>";
			#echo " <td><form method='post' action = ''><input type='submit' value='accept' name></td>";
			echo "</tr>";
			}
			echo "</table>";


		?>
	</div>

	<script type="text/javascript"></script>
</body>
</html>